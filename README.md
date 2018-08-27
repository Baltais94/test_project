# test_project
Test project app
####
Šis testa projekts tika veidots un testēts uz PHP versijas 5.6 un izmantojot MySQL ar versiju 5.7;

Projektā tika izmantoti php short tags, līdz ar to iekš php.ini faila, ja tas nav izdarīts, ir nepieciešams atļaut tos izmantot;

php.ini
	short_open_tag=On
	

Datubāzei nepieciešamais fails atrodas root direktorijā ar nosaukumu test_db.sql .

Datubāzes piekļuves mainīgie atrodās iekš classes.php klases dbo, kuri attiecīgi ir jānomaina uz testējamā servera parametriem.
