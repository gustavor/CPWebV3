function getEvento(tipo)
{
    switch(tipo)
    {
        case '':
        default:
            $("#divEventoEvento").fadeOut();
            break;
        case '65': //publicação
            $("#divEventoEvento").fadeIn();
            break;
    }
}
