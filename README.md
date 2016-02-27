WorldEditArt - ![WorldEditArt](plugin_icon.png)
===

Please see [the webpage on gh-pages](//pemapmodder.github.io/WorldEditArt/guide/) for user guides.

Check out the [Doxygen-generated API docs](//pemapmodder.github.io/WorldEditArt/doxygen).

TODO list:

- [ ] Delta
    - [ ] Frameworks
        - [X] Language
        - [ ] World editing session control system
            - [ ] Allow any command senders (via the CommandControlledSession class) to execute world editing
            - [ ] Selections (support multiple selections at the same time)
        - [ ] Spaces library
        - [ ] Action (Redo/Undo) system and action pool (rheostats)
        - [ ] Providers framework
            - [ ] Framework
            - [ ] Implementations
                - [ ] Filesystem
                - [ ] MySQL (not priority)
        - [X] Base command class
    - [ ] Utils
        - [ ] Async database querying system
        - [X] Fridge
    - [ ] Features
        - [ ] Safety
            - [ ] Sudo mode
            - [ ] Safe mode
                - [ ] Marking and storing of UCZs
                - [X] Safe mode
        - [ ] Commands
            - [X] //help
            - [ ] Selection creation
                - [ ] //shoot
                - [ ] //grow
                - [ ] //cyl
                - [ ] //sph
                - [ ] //desel
                - [ ] //1, //2
            - [ ] Selection processing
                - [ ] //set
                - [ ] //replace
                - [ ] //test
            - [ ] Copying
                - [ ] //copy
                - [ ] //cut
                - [ ] //paste
        - [ ] Jump
        - [ ] Wand
        - [ ] Macros
            - [ ] Storage
            - [ ] Database

Compiling
===
This plugin uses the _NOWHERE framework_. Running from source with DevTools or direct compiling is **not** available. Instead, find a build from the `bin` directory, or compile your fork's changed by running [`compile.php`](compile.php) with PHP 7.

Translating
===
The language framework of this plugin is _XML-based_, _backwards-compatible_ with _fallback language_ and _constant definition_ support.

1. Press the "Fork" button on the top right corner of this webpage. This will create a fork of this repository owned by you.
2. Go to the `resources` folder, then the `lang` folder.
3. Find the language file for the language you want to create. If there isn't one:
    1. Click the `New file` button above the list of files.
    2. Put the appropriate filename (end it with `.xml`)
    3. Paste these into the file:

```xml
<?xml version="1.0" encoding="UTF-8" ?>

<!--
	WorldEditArt

	Copyright (C) 2016 LegendsOfMCPE

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU Lesser General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	@author LegendsOfMCPE
-->

<language name="en" version="1.0" rel="1.0">
	<authors since="1.0" updated="1.0">
		<author>PEMapModder</author>
	</authors>
	<constants>
		<constant name="FORMAT_ERROR">§c</constant>
		<constant name="FORMAT_WARNING">§e</constant>
		<constant name="FORMAT_PROGRESS">§8</constant>
		<constant name="FORMAT_SUCCESS">§a</constant>
		<constant name="FORMAT_INFO">§f</constant>
		<constant name="FORMAT_HIGHLIGHT">§b</constant>
		<constant name="FORMAT_HIGHLIGHT_1">§b</constant>
		<constant name="FORMAT_HIGHLIGHT_2">§9</constant>
		<constant name="FORMAT_HIGHLIGHT_3">§5</constant>
		<constant name="FORMAT_HIGHLIGHT_4">§d</constant>
	</constants>
	<values>
	</values>
</language>
```

    4. 