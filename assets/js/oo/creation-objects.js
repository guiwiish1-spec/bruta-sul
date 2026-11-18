// Unidade 8.2 — Criação de objetos.
// Object.create, Object.assign e Object.defineProperty são usados para montar
// um modelo de visualização sem alterar o objeto recebido da página.
export function createScheduleView(data, defaults = {}) {
    const view = Object.create(defaults);
    Object.assign(view, data);

    Object.defineProperty(view, 'displayHour', {
        value: String(data.hour ?? '').slice(0, 5),
        enumerable: true,
        writable: false,
        configurable: false
    });

    return view;
}
