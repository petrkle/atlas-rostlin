var idx = lunr(function () {
  this.ref('id')
  this.field('id')
  this.field('jmeno')
  this.field('popis')
  this.field('celed')

	this.pipeline.remove(lunr.trimmer)

  kytky.forEach(function (doc) {
    this.add(doc)
  }, this)
})

var db = kytky.reduce(function (foo, document) {
    foo[document.id] = document
    return foo
}, {})

document.addEventListener('DOMContentLoaded',function() {
    document.querySelector('input[name="q"]').onkeyup=vyhledavani;
},false);

function vyhledavani(event) {
	var result = idx.search('*'+ event.target.value + '*', ('id', 'jmeno'));
	var seznam = '';
	for (var key in result) {
			var kytka = result[key];
		seznam = seznam + '<li><a href="' + kytka.ref + '.html">' + db[kytka.ref].jmeno + '</a></li>';
	}
	document.getElementById("vysledky").innerHTML = seznam;
}
