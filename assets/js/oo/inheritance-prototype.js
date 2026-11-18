// Unidade 8.5 — Herança prototípica, sobrescrita e composição.
const BaseModality = {
    category: 'Treinamento',
    getCategory() {
        return this.category;
    }
};

const CombatModality = Object.create(BaseModality);
CombatModality.category = 'Arte marcial';
CombatModality.isCombat = true;

const FitnessModality = Object.create(BaseModality);
FitnessModality.category = 'Condicionamento físico';
FitnessModality.isCombat = false;

const searchable = {
    matches(term) {
        const value = `${this.name ?? ''} ${this.teacher ?? ''}`.toLocaleLowerCase('pt-BR');
        return value.includes(term.toLocaleLowerCase('pt-BR'));
    }
};

export function createModalityRecord(data) {
    const name = String(data.modality ?? data.name ?? '');
    const isFitness = name.toLocaleLowerCase('pt-BR') === 'musculação';
    const modality = Object.create(isFitness ? FitnessModality : CombatModality);
    Object.assign(modality, data);
    Object.assign(modality, searchable); // composição de comportamento (mixin)
    return modality;
}

export function hasOwnModalityField(modality, field) {
    return Object.hasOwn(modality, field);
}

// Demonstra a inspeção da cadeia e a relação de protótipo.
export function isCombatModality(modality) {
    return CombatModality.isPrototypeOf(modality);
}
