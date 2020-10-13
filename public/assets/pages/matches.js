const matches = {
    MATCH_SCHEDULE: '#matches',
    INPUTS: {
        DATE: '#form-matches input[name="matchDate"]'
    },

    championshipMatches: '',

    process: function (date) {
        matches.clearScreen();
        matches.findMatches(date);
    },

    clearScreen: function () {
        $(matches.MATCH_SCHEDULE).html("");
    },

    findMatches: function (date) {
        matchesEndpoints.readMatches(date)
            .then(function (response) {
                matches.data = response.data;
                matches.render(response.data);
            })
            .catch(function (error) {
                swal("Ooops!", "Não foram encontrados jogos na data informada!", "info");
            });
    },

    render: function (obj) {
        for (const [key, value] of Object.entries(obj)) {

            value.forEach(function (match) {
                let homeTeamBadge = null !== match.equipe_mandante.escudos.svg && '' !== match.equipe_mandante.escudos.svg
                    ? match.equipe_mandante.escudos.svg
                    : match.equipe_mandante.escudos['60x60'];

                let visitingTeamBadge = null !== match.equipe_visitante.escudos.svg && '' !== match.equipe_visitante.escudos.svg
                    ? match.equipe_visitante.escudos.svg
                    : match.equipe_visitante.escudos['60x60'];

                let homeTeamClass = 'hnqIx';
                let visitingTeamClass = 'hnqIx';
                let visitingTeamIcon = '';
                let homeTeamIcon = '';
                let winnerIcon = '<span class="icone-vencedor"><svg width="7" height="14" xmlns="http://www.w3.org/2000/svg"><path d="M7 0L0 7l7 7z" fill="#111" fill-rule="nonzero"></path></svg></span>';
                if (match.vencedor_jogo.label === 'mandante') {
                    homeTeamIcon = winnerIcon;
                    visitingTeamClass = 'dRjzRU';
                } else if (match.vencedor_jogo.label === 'visitante') {
                    visitingTeamIcon = winnerIcon;
                    homeTeamClass = 'dRjzRU';
                }

                matches.championshipMatches = matches.championshipMatches + `
                    <a class="jvogzF">
                        <span class="gEOnZC">Sem informações adicionais deste jogo.</span>
                        <div class="USXGP">
                            <span>Futebol</span>
                            <div>Encerrado</div>
                        </div>
                        <div class="${homeTeamClass}">
                            <div class="dEdVAy">
                                <img src="${homeTeamBadge}" class="fmHiTT" alt="home team badge"><span class="kTtIQX">${match.equipe_mandante.nome_popular}</span>
                            </div>
                            <div class="liBlbn">
                                <span class="gols">${match.placar_oficial_mandante}</span>${homeTeamIcon}
                            </div>
                        </div>
                        <div class="${visitingTeamClass}">
                            <div class="dEdVAy">
                                <img src="${visitingTeamBadge}" class="fmHiTT" alt="visiting team badge"><span class="kTtIQX">${match.equipe_visitante.nome_popular}</span>
                            </div>
                            <div class="liBlbn">
                                <span class="gols">${match.placar_oficial_visitante}</span>${visitingTeamIcon}
                            </div>
                        </div>
                        <span class="jCIdtH">Rodada ${match.rodada}</span>
                    </a>
                `;
            });

            $(matches.MATCH_SCHEDULE).append(`
                <div class="ecJnUi">
                    <div class="fksWrf">${key}</div>
                    <div class="kJqIhS">
                        ${matches.championshipMatches}
                    </div>
                </div>
            `);

            matches.championshipMatches = '';
        }
    }
};

$(function () {
    $(matches.INPUTS.DATE).datetimepicker({
        lang: 'pt-BR',
        format: 'd/m/Y',
        formatDate: 'd/m/Y',
        datepicker: true,
        timepicker: false,
        mask: '39/19/9999',
        yearStart: '2019',
        yearEnd: '2019',
        dayOfWeekStart: 0,
        onSelectDate: function (ct, input) {
            matches.process(moment(input.val(), 'DD/MM/YYYY').format('YYYY-MM-DD'));
        },
    }).val(moment('2019-01-01', 'YYYY-MM-DD').format('L'));

    matches.process(moment('2019-01-01', 'YYYY-MM-DD').format('YYYY-MM-DD'));
});


