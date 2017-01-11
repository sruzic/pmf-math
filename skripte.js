function oboji(x)
{
document.getElementById(x.id).style.background="#5CE62E";
var classlist = document.getElementById(x.id).classList;
	for (var i = 0; i < classlist.length; i++) {
		var temp = classlist[i]
		var norm = temp;			
		var malena = temp.toLowerCase();
		if (norm == malena){
			document.getElementById(malena).style.background="#ff9200";
		}
		else
			document.getElementById(malena).style.background="#fbff00 ";
	}
}

function izbrisi(x)
{
document.getElementById(x.id).style.background="";
var classlist = document.getElementById(x.id).classList;
	for (var i = 0; i < classlist.length; i++) {
		var temp = classlist[i]
		var norm = temp;			
		var malena = temp.toLowerCase();
		if (norm == malena){
			document.getElementById(malena).style.background="";
		}
		else
			document.getElementById(malena).style.background="";
	}
}