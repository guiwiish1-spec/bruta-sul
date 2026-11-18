import { createGymRecord, inspectRecordPrototype, inspectBuiltInPrototypes } from './oo/oo-prototypal.js';
import { createScheduleView } from './oo/creation-objects.js';
import { cloneRecords, shallowClone } from './oo/cloning-objects.js';
import { SCHEDULE_CONFIG, createFilterState, createPageMetadata, scheduleConfigIsFrozen } from './oo/mutability-objects.js';
import { createModalityRecord, hasOwnModalityField, isCombatModality } from './oo/inheritance-prototype.js';
import { ScheduleItem, GymVisitor, internalRecordId, createVisitorWithCall } from './oo/constructor-functions.js';

const pageMetadata = createPageMetadata(document.body.className || 'bruta-sul');
const visitor = new GymVisitor('Visitante');
const visitorCreatedWithCall = createVisitorWithCall('Visitante');
const builtInPrototypes = inspectBuiltInPrototypes();
const visitorPrototype = Object.getPrototypeOf(visitor);
if (!(visitor instanceof GymVisitor) || !(visitorCreatedWithCall instanceof GymVisitor) || typeof visitorPrototype.getName !== 'function' || !scheduleConfigIsFrozen || !Object.values(builtInPrototypes).every(Boolean)) {
    console.warn('Verificação dos recursos de orientação a objetos não concluída.');
}
visitor[internalRecordId] = 'bruta-sul-session';
const scheduleCards = [...document.querySelectorAll('[data-schedule-card]')];

if (scheduleCards.length) {
    const scheduleData = scheduleCards.map((card) => {
        const heading = card.querySelector('h3')?.textContent?.trim() ?? '';
        const paragraphs = [...card.querySelectorAll('p')].map((item) => item.textContent.trim());
        const hour = card.querySelector('span')?.textContent?.trim() ?? '';
        const teacherText = paragraphs.find((value) => value.startsWith('Professor:')) ?? '';
        const teacher = teacherText.replace('Professor:', '').trim();

        // 8.1: registro criado com um protótipo que fornece métodos compartilhados.
        const record = createGymRecord({
            modality: heading,
            weekDay: paragraphs[0] ?? '',
            hour,
            teacher
        });

        // 8.2: objeto de visualização criado com Object.create/assign/defineProperty.
        const recordPrototype = inspectRecordPrototype(record);
        const shallowRecordCopy = shallowClone(record);
        void shallowRecordCopy;
        if (recordPrototype !== Object.getPrototypeOf(record)) {
            console.warn('Cadeia de protótipos inesperada.');
        }
        return createScheduleView(record, { source: 'Bruta Sul' });
    });

    // 8.3: clonagem profunda antes de aplicar operações de interface.
    const safeScheduleCopy = cloneRecords(scheduleData);

    // 8.4: configuração congelada e estado selado.
    const filterState = createFilterState();
    const metadata = pageMetadata;
    const search = document.querySelector('[data-schedule-search]');
    const count = document.querySelector('[data-schedule-count]');
    const empty = document.querySelector('[data-schedule-empty]');

    function renderSchedules(term = '') {
        filterState.search = term.trim();
        const query = filterState.search;

        const visible = safeScheduleCopy
            .map((item) => createModalityRecord(item))
            .filter((item) => item.matches(query));

        filterState.total = visible.length;

        scheduleCards.forEach((card) => {
            const modality = card.querySelector('h3')?.textContent?.trim() ?? '';
            const paragraphs = [...card.querySelectorAll('p')].map((p) => p.textContent.trim());
            const teacher = (paragraphs.find((value) => value.startsWith('Professor:')) ?? '').replace('Professor:', '').trim();
            const record = createModalityRecord({ modality, teacher });
            const shouldShow = record.matches(query);
            card.dataset.category = isCombatModality(record) ? 'combat' : 'fitness';
            card.hidden = !shouldShow;
            card.classList.toggle(SCHEDULE_CONFIG.visibleClass, shouldShow);
        });

        if (count) count.textContent = `${filterState.total} ${filterState.total === 1 ? 'aula encontrada' : 'aulas encontradas'}`;
        if (empty) {
            empty.hidden = filterState.total !== 0;
            empty.textContent = SCHEDULE_CONFIG.emptyMessage;
        }

        // 8.6: classe com herança (Teacher extends Person), super e instanceof.
        const first = visible[0];
        if (first) {
            const schedule = new ScheduleItem({
                modality: first.modality,
                teacher: first.teacher,
                weekDay: first.weekDay,
                hour: first.displayHour
            });
            if (schedule instanceof ScheduleItem && hasOwnModalityField(first, 'modality')) {
                document.documentElement.dataset.schedulePreview = schedule.getSummary();
            }
        }

        // Metadados protegidos contra inclusão de novas propriedades.
        document.documentElement.dataset.currentPage = metadata.page;
    }

    if (search) {
        search.placeholder = SCHEDULE_CONFIG.searchPlaceholder;
        search.addEventListener('input', () => renderSchedules(search.value));
    }
    renderSchedules();
}
