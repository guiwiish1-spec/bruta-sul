// Unidade 8.6 — Funções construtoras, classes, herança, super e campos privados.
export class Person {
    #name;

    constructor(name) {
        this.#name = name;
    }

    get name() {
        return this.#name;
    }

    getSummary() {
        return this.#name;
    }
}

export class Teacher extends Person {
    constructor(name, specialty) {
        super(name);
        this.specialty = specialty;
    }

    getSummary() {
        return `${super.getSummary()} — ${this.specialty}`;
    }
}

export class ScheduleItem {
    static itemType;

    static {
        // Bloco estático: executado uma vez quando a classe é carregada.
        this.itemType = 'aula';
    }

    constructor({ modality, teacher, weekDay, hour }) {
        this.modality = modality;
        this.teacher = new Teacher(teacher, modality);
        this.weekDay = weekDay;
        this.hour = hour;
    }

    getSummary() {
        return `${this.modality} — ${this.weekDay} às ${this.hour} — ${this.teacher.name}`;
    }
}

// Função construtora tradicional (antes da sintaxe class).
export function GymVisitor(name) {
    this.name = name;
}

GymVisitor.prototype.getName = function () {
    return this.name;
};

// Symbol cria uma propriedade de identificação menos exposta por colisões de nomes.
export const internalRecordId = Symbol('internalRecordId');

// call() permite reutilizar uma função construtora em um objeto já criado.
export function createVisitorWithCall(name) {
    const visitor = Object.create(GymVisitor.prototype);
    GymVisitor.call(visitor, name);
    return visitor;
}
