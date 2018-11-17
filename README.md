# Bid Data - Practical Exam
# mtg-project
Create MTG Trading Card Database by API

## dll
Contains two SQL files:
- "mtg_cards.sql" --> for HIVE
- "mtg_cards.psql" --> for POSTGRES

## final
Folder to save locally the generated "mtg_cards_final.csv"

## jobs
Main workflow "mtg_workflow.kjb" contains 4 other jobss:
- IMPORT: "mtg_export.kjb"
Starts a shell script "scripts/mtgPageDownloader.sh" that is downloading all the files from https://api.magicthegathering.io/v1/cards?page=<pagenumber>
By reading the header files attribute "link", it is possible to tell if the last page has been reached.
Starting from page=1: While returned header "link" does contain last, download current page and get next page (counter++).

- PARSE: "mtg_parse.kjb"
Contains a Transformation ""transformations/mtg_parse.ktr" that is parsing all the downloaded JSON files. It maps the relevant data into one output. This output is sorted and duplicates will be filtered.
Next, it generates a CSV and saves it into a folder "final".

- MOVE: "mtg_move.kjb"
Starts a shell script "scripts/hdfsMoveData.sh" that is creating required hdfs path and moving the processed file "final/mtg_cards_final.csv" to hdfs.

- EXPORT: "mtg_export.kjb"
The last step EXPORT contains a transformation "transformations/mtg_export.ktr"
First it truncates and resets the psql table in order to write the read new data from Hive to Postgres 

## transformations
Two transformations "mtg_parse.ktr" and "mtg_export.ktr" described above.

## kettle
Contains "kettle.properties", set these in your pentaho environment!
Properties are documented inside.

## scripts
Two bash scripts "hdfsMoveData.sh" and "mtgPageDownloader.sh" desbribed above.

## frontend
Classic Fronted with: 
- HTML
- MaterializeCSS
- Javascript
- jQuery

## installation
1. Install Dependencies
- Hadoop
- Hive2
- HiveServer2
- Pentaho
- Apache https://www.vultr.com/docs/how-to-install-apache-mysql-and-php-on-ubuntu-16-04
- PHP
- PostgreSQL https://www.digitalocean.com/community/tutorials/how-to-install-and-use-postgresql-on-ubuntu-16-04
2. Start Services
- /etc/init.d/apache2 start
- start-dfs.sh
- start-yarn.sh
- hiveserver2
- /opt/pdi/spoon.sh
3. Clone Repository to desired location
4. Setup kettle.properties (look repository folder "kettle")
5. Execute using kitchen.sh with desired values
/opt/pdi/kitchen.sh -file=<Path to mtg_workflow.kjb> -param:load_day=<day> -param:load_month=<month> -param:load_year=<year>

