var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/')+1);

var bookmarks = [];

if (localStorage.getItem('bookmarks') != null) {
	bookmarks = JSON.parse(localStorage.getItem('bookmarks'));
}

if(filename == 'index.html'){

for(var i=0; i<bookmarks.length; i++){

	ul = document.getElementsByTagName("ul");
	seznam = document.getElementsByTagName("li");

		var li = document.createElement("li");
		li.className = "bookmark";
		var a = document.createElement("a");
		a.href = bookmarks[i].link;
		a.textContent = bookmarks[i].nadpis;
		a.className = "bm";
		li.appendChild(a);
		ul[0].insertBefore(li,seznam[0]);
	}

}else{

var hvezdicka = document.getElementsByClassName("hvezdicka");
var hlavicka = document.getElementsByClassName("hlavicka");
var nadp = hlavicka[0].textContent;

var pridano = false;

for(var j=0; j<bookmarks.length; j++){
	if(filename == bookmarks[j].link){
		hvezdicka[0].style.backgroundImage = 'url(star.svg)';
		pridano = true;
	}
}

if(pridano){
	hvezdicka[0].addEventListener('click', function(e) {
		for(var foo=0; foo<bookmarks.length; foo++){
			if(bookmarks[foo].link == filename){
				bookmarks.splice(foo, 1);
			}
		}
		localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
		location.reload(true);
	});
}else{
	hvezdicka[0].addEventListener('click', function(e) {
			var zalozka = { nadpis: nadp, link: filename};
			var pridano = false;

			for(var foo=0; foo<bookmarks.length; foo++){
				if(bookmarks[foo].filename == filename){
					pridano = true;
				}
			}

			if(!pridano){
				bookmarks.push(zalozka);
			}
			localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
			location.reload(true);
	});
}

}
