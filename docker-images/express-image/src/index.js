var Chance = require('chance');
var chance = new Chance();

var express = require('express');
var app = express();

app.get('/', function(req, res) {
	res.send( generateCompanies() );
});

app.listen(3000, function() {
	console.log("Accepting HTTP requests on port 3000!");
});

function generateCompanies() {
	var numberOfCompanies = chance.integer({
		min: 0,
		max: 10
	});
	
	console.log(numberOfCompanies);
	var companies = [];
	for(var i = 0; i < numberOfCompanies; i++) {
		var name = chance.company();
		var foundationYear = chance.year({
			min: 2000,
			max: 2018
		});
		var origin = chance.country();
		var website = chance.url({domain: 'www.'+name+'.com'});
		var profit = chance.dollar({max: 100000000});
		companies.push({
			name: name,
			foundationYear: foundationYear,
			origin : origin,
			profit : profit,
			website : website
		});
	};
	console.log(companies);
	return companies;
}