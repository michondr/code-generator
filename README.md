## chapter maker

this all started one beautiful day, when I signed for a semester of [Software Architectures](https://insis.vse.cz/katalog/syllabus.pl?predmet=160892) - well, it was not what it sounds like.

the task for the final exam was to prepare assigment for "average programmer", so that he can build a piece of software that splits code into chapters.
these chapters are then used while writing a book or an article.

so, one file which has some notations that state if the row of code should be added or removed at that chapter

...apparently git is not suitable for this (it was at first, but then the teacher came with more reasons why git is unusable)

### how does it work
the single file is split into multiple versions. these versions are based on numeric sequence.

1) you append `//~` suffix which should kick in as comment in Java or Php or many more.
   * so that you can run the code of final chapter. just comment out what is to be removed, and it will show in that version 
2) you specify if the change was addition of the line or removal by `+` and `-` signs respectively.
3) you can add two of these eg, `//~ +2 -3` meaning that it was added in second chapter and removed in third.
4) rows without suffixes are carried from the start (from version 0)
5) output is all the chapter files
    * there are blank lines, the file has same number of rows as the input line (you see changes just by switching between them) - any refformat IDE will handle this in notime
    * output files have the same type (`.txt`, `.php`, `.java`, `.this-in-not-even-file-type`)
    * output files are in the folder specified with run command
    * output files have names `0.foo`,`1.foo`,`2.foo`,`3.foo`, etc...
    * how many chapters you add, that many files you'll end up with, plus the 0 version
    
6) bugs might occur, this is one-late-night-project, I do not get paid to do school
7) phpunit tests added, spend like 1/3 time on them (other 1/3 was tinkering and 1/3 was making it work)
   * `./phpunit --bootstrap src/autoload.php tests`
8) few example files added in `tests/_fixture/`

### examples

command: `php split_to_chapters.php tests/_fixture/foo_easy.php output3`

input file:
```php
<?php

//declare(strict_types = 0); //~ +1 -2
declare(strict_types = 1); //~ +2

die('done'); //~ +3
echo "done"; //~ -3 +2
```
base chapter `0.php`: 
```php
<?php







```
first chapter `1.php`:
```php
<?php

declare(strict_types = 0);





```
second chapter `2.php`:
```php
<?php


declare(strict_types = 1);


echo "done";

```
third chapter `3.php`:
```php
<?php


declare(strict_types = 1);

die('done');


```