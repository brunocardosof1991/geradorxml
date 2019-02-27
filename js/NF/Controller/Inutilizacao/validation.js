//Validar inputs da inutilização - Inicio
export function isValidInicio(Inicio) {
    return Inicio.length === 9;
}

export function validateInicioField(Inicio, event) {
    if (!isValidInicio(Inicio)) {
        alert('Inicio Inválido, Somente 9 Dígitos Será Aceito!')
        event.stopImmediatePropagation();
    }
}
//Validar inputs da inutilização - Fim
export function isValidFim(Fim) {
    return Fim.length === 9;
}

export function validateFimField(Fim, event) {
    if (!isValidFim(Fim)) {
        alert('Fim Inválido, Somente 9 Dígitos Será Aceito!')
        event.stopImmediatePropagation();
    }
}
//Validar inputs da inutilização - JUstificativa
export function isValidJust(Just) {
    return Just.length > 2 && Just.length < 250;
}

export function validateJustField(Just, event) {
    if (!isValidJust(Just)) {
        alert('Justificativa Inválido!')
        event.stopImmediatePropagation();
    }
}   