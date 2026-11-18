// Unidade 8.4 — Mutabilidade.

export function deepFreeze(value) {
    if (value && typeof value === 'object' && !Object.isFrozen(value)) {
        Object.getOwnPropertyNames(value).forEach((key) => deepFreeze(value[key]));
        Object.freeze(value);
    }
    return value;
}

export const SCHEDULE_CONFIG = deepFreeze({
    emptyMessage: 'Nenhuma aula encontrada para esse filtro.',
    searchPlaceholder: 'Buscar modalidade ou professor...',
    visibleClass: 'is-visible',
    display: { showTeacher: true, showHour: true }
});

// O estado pode ter seus valores atualizados, mas não receber/remover propriedades.
export function createFilterState() {
    const state = Object.seal({ search: '', total: 0 });
    // Object.isSealed confirma a proteção contra inclusão/remoção de propriedades.
    if (!Object.isSealed(state)) throw new Error('O estado de filtro deveria estar selado.');
    return state;
}

// Metadados de sessão são fechados para impedir a inclusão acidental de propriedades.
export function createPageMetadata(pageName) {
    const metadata = { page: pageName, initialized: true };
    Object.preventExtensions(metadata);
    // Object.isExtensible confirma que novas propriedades não podem ser adicionadas.
    if (Object.isExtensible(metadata)) throw new Error('Os metadados não deveriam ser extensíveis.');
    return metadata;
}

// Object.isFrozen é usado para validar a configuração imutável.
export const scheduleConfigIsFrozen = Object.isFrozen(SCHEDULE_CONFIG);
