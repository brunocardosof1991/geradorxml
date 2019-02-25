
//Validar CFOP
export function isValidCFOP(CFOP) {
    return CFOP === '5101' || CFOP === '5102' || CFOP === '5103' || CFOP === '5104' || CFOP === '5115' || CFOP === '5405' || CFOP === '5656' || CFOP === '5667' || CFOP === '5933';
}

export function validateCFOPField(CFOP, event) {
    if (!isValidCFOP(CFOP)) {
        $("#CFOP-feedback").text("CFOP Inválido").css('color', 'red');
        alert('CFOP Inválido!')
        event.stopImmediatePropagation();
    } else {
        $("#CFOP-feedback").text("");
    }
}
//Validar cEAN
export function isValidcEAN(cEAN) {
    return cEAN.length === 8;
}

export function validatecEANField(cEAN, event) {
    if (!isValidcEAN(cEAN)) {
        $("#cEAN-feedback").text("cEAN Inválido").css('color', 'red');
        alert('cEAN Não Contêm 8 Dígitos!')
        event.stopImmediatePropagation();
    } else {
        $("#cEAN-feedback").text("");
    }
}
//Validar NCM
export function isValidNCM(NCM) {
    return NCM.length === 8;
}

export function validateNCMField(NCM, event) {
    if (!isValidNCM(NCM)) {
        $("#NCM-feedback").text("NCM Inválido").css('color', 'red');
        alert('NCM Inválido!')
        event.stopImmediatePropagation();
    } else {
        $("#NCM-feedback").text("");
    }
}
//Validar Preço  
export function isValidpreco_custo(preco_custo) {
    return preco_custo.length >= 1 && preco_custo.length <= 30;
}

export function validatepreco_custoField(preco_custo, event) {
    if (!isValidpreco_custo(preco_custo)) {
        $("#preco_custo-feedback").text("Preço Inválido").css('color', 'red');
        alert('Preço Inválido!')
        event.stopImmediatePropagation();
    } else {
        $("#preco_custo-feedback").text("");
    }
}
//Validar Descrição  
export function isValidDescricao(Descricao) {
    return Descricao.length >= 2 && Descricao.length <= 250;
}

export function validateDescricao(Descricao, event) {
    if (!isValidDescricao(Descricao)) {
        $("#descricao-feedback").text("Descriçao Inválido").css('color', 'red');
        alert('Descriçao Inválido!')
        event.stopImmediatePropagation();
    } else {
        $("#descricao-feedback").text("");
    }
}   