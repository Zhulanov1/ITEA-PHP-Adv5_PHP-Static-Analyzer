PHP Static Analyzer
===================

![Custom badge](https://img.shields.io/badge/greeflas-default--project-red.svg)

Installation
------------

TODO

Usage
-----

`$ ./bin/console stat:class-author <email> <project-src>` - counts classes/interfaces/trait
created by some developer in project.

`$ ./bin/console class-info <full-class-name>` - this command shows class information in format

Class: {{class_name}} is {{class_type}}  
Properties:  
&nbsp;&nbsp;&nbsp;&nbsp; public: {{count}}  
&nbsp;&nbsp;&nbsp;&nbsp; protected: {{count}}  
&nbsp;&nbsp;&nbsp;&nbsp; private: {{count}}  
Methods:  
&nbsp;&nbsp;&nbsp;&nbsp; public: {{count}}  
&nbsp;&nbsp;&nbsp;&nbsp; protected: {{count}}  
&nbsp;&nbsp;&nbsp;&nbsp; private: {{count}}

> Attention! Need to duplicate backslashes in `<full-class-name>` for example `Greeflas\\StaticAnalyzer\\Test\\A`

Code style fixer
----------------


To fix the code style just run the following command

```
$ composer cs-fix
```

License
-------

[![license](https://img.shields.io/github/license/greeflas/default-project.svg)](LICENSE)

This project is released under the terms of the BSD-3-Clause [license](LICENSE).

Copyright (c) 2019, Vladimir Kuprienko
