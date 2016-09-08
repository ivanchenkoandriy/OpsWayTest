OpsWay PHP TEST for Senior Developer level
============

This is example application for data migration from any source data to any destination data.

Attention, this test is created deliberately complex to reflect real-world complexities that are met in day-to-day work

You have 24 hours to complete the test, but pay attention that time spent affects your overall score:

You'll get 3 points if test is done <=3 hours, 2 point <=6 hours, 1 point it done <24 hours.  

Installation
------------

 
```
composer install
```

Usage
------

* CLI mode
```
php cli.php {reader} {writer}
```
* WEB mode
```
php -S localhost:8000
```
  Open browser on http://localhost:8000/web.php?reader={ReaderName}&writer={WriterName}
  


Task description 
-------

**Important!** All comment in commits should contained task number (cast sensitive) : "TASK 2", "TASK 3", etc

1. Investigate application (ignore /tests folder) and write short description (no more than 100 words: how it works for every class you meet in functional on each classes, etc) to data/comments/1.txt file. Commit this file.

2. Run cli.php in CLI mode for export all products to console output writer. 
Redirect using redirect operator (https://en.wikipedia.org/wiki/Redirection_(computing)#Basic) console output to file data/2.txt. 
Put the commands you used to data/comments/2.txt. Commit both files.

3. Run cli.php in CLI mode for export all products to data/export.csv file.
Fix bug in CSV writer. Commit export.csv file and fix to repo.

4. Run web.php in WEB mode for export all products to HTML writer. 
Fix bug with output (remove extra top symbols), but don't touch ConsoleLogger class.
Take a screenshot with result table and save to data/3.jpg. 
Commit fix and screenshot to repo.

5. Copy cli.php to new_cli.php file.
Remove instantiation of ConsoleLogger class from new_cli.php.
Implement same functionality (with debug mode = true and counting and output it each 2 item) with anonymous function or closure.
Commit changes.

6. Write new CSV reader class (OpsWay\Migration\Reader\File\Csv) which should parse export.csv created as a result of Task 3. Reader should return items include keys column which use csv in header (exclude itself).
Write new OutOfStockLogger class that will log in CSV format (use exist Writer Csv class for writing to file) rows that have only qty == 0 & is_stock == 0
Run cli.php in CLI mode with OutOfStockLogger instead ConsoleLogger and use created CSV reader with Stub writer
Commit code changes and include result OutOfStockLogger csv file as /data/output.log.csv
