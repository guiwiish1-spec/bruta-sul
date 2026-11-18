// Unidade 8.1 — Orientação a objetos prototípica.
// Os registros compartilham métodos pelo prototype, em vez de duplicá-los.
export const GymRecordPrototype = {
    getLabel() {
        return this.name ?? this.modality ?? 'Registro da academia';
    },
    getDescription() {
        return this.description ?? this.specialty ?? '';
    }
};

export function createGymRecord(data) {
    return Object.assign(Object.create(GymRecordPrototype), data);
}

// Object.getPrototypeOf permite inspecionar a cadeia de protótipos.
export function inspectRecordPrototype(record) {
    return Object.getPrototypeOf(record);
}

// Em código novo, prefira Object.getPrototypeOf() a acessar __proto__,
// que é uma propriedade legada/depreciada para esse tipo de inspeção.

export function inspectBuiltInPrototypes() {
    return {
        object: Object.getPrototypeOf({}) === Object.prototype,
        array: Object.getPrototypeOf([]) === Array.prototype,
        function: Object.getPrototypeOf(function () {}) === Function.prototype
    };
}
