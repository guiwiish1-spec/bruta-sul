// Unidade 8.3 — Clonagem de objetos.

// Cópia rasa: cria outro objeto, mas referências internas continuam compartilhadas.
export function shallowClone(record) {
    return { ...record };
}

// Cópia profunda: cria uma cópia independente dos dados aninhados.
export function cloneRecords(records) {
    if (typeof structuredClone === 'function') {
        return structuredClone(records);
    }
    // Alternativa para dados serializáveis em JSON (não preserva Date, Map, Set,
    // undefined, funções ou referências circulares).
    return JSON.parse(JSON.stringify(records));
}
