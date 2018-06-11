$(function() {
        console.log("Loading companies");

        function loadCompanies() {
        $.getJSON( "/api/company/", function( companies ) {
                console.log(companies);
                var message = "No companies sorry!";
                if ( companies.length > 0 ) {
                        message = companies[0].name;
                }
                $(".intro-lead-in").text(message);
        });

};


loadCompanies();
setInterval(loadCompanies, 3000);

});