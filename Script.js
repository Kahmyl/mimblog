var owner = $('#owner'),
    b = $('#cardNumber'),
    cardNumberField = $('#card-number-field'),
    CVV = $("#cvv"),
    mastercard = $("#mastercard"),
    confirmButton = $('#confirm-purchase'),
    visa = $("#visa"),
    amex = $("#amex");

b.payform('formatCardNumber');
CVV.payform('formatCardCVC');