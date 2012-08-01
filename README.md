jQuery-File-Tree
================

jQuery File Tree is a configurable, AJAX file browser plugin for jQuery. You can create a customized, fully-interactive file tree with as little as one line of JavaScript code.

Currently, server-side connector scripts are available for PHP, ASP, ASP.NET, JSP, and Lasso. If you’re a developer, you can easily make your own connector to work with your language of choice.

jQuery File Tree requires jQuery 1.2.6 or above.

This GitHub repo consists of the unmaintained copy of jQuery File Tree (v1.01 from 12 April 2008), with the intention to update it.

Creating a File Tree
--------------------

In it’s simplest form, you can create a file tree using the following code:

    $(document).ready( function() {
        $('#container_id').fileTree({ root: '/some/folder/' }, function(file) {
            alert(file);
        });
    });

where ```#container_id``` is the ID of an empty DIV element that exists on your page. The file tree will automatically load when your page loads.

Configuring the File Tree
-------------------------

Parameters are passed as an object to the fileTree() function. Valid options include:

    Parameters      Description Default Value
    root            root folder to display  /
    script          location of the serverside AJAX file to use jqueryFileTree.php
    folderEvent     event to trigger expand/collapse    click
    expandSpeed     Speed at which to expand branches (in milliseconds); use -1 for no animation    500
    collapseSpeed   Speed at which to collapse branches (in milliseconds); use -1 for no animation  500
    expandEasing    Easing function to use on expand    None
    collapseEasing  Easing function to use on collapse  None
    multiFolder     Whether or not to limit the browser to one subfolder at a time  true
    loadMessage     Message to display while initial tree loads (can be HTML)   Loading…

To create a file tree with multiple parameters, your code will look something like this:

    $(document).ready( function() {
        $('#container_id').fileTree({
            root: '/some/folder/',
            script: 'jqueryFileTree.asp',
            expandSpeed: 1000,
            collapseSpeed: 1000,
            multiFolder: false
        }, function(file) {
            alert(file);
        });
    });

Styling the File Tree
---------------------

The file tree relies 100% on CSS for styling. To give your users an aesthetically pleasing experience, you should either use the included stylesheet for your file tree or create your own. Refer to jqueryFileTree.css to make any changes in the styles.

Handling Feedback
-----------------
When a file is selected, jQuery File Tree passes the filename back as a string. The easiest way to capture and handle this is by using an anonymous function. If you want to pass the selected filename to a function you create calledopenFile(), your code will look like this:

    function openFile(file) {
        // do something with file
    }

    $(document).ready( function() {
        $('#container_id').fileTree({ [options] }, function(file) {
            openFile(file);
        });
    });

Connector Scripts
-----------------

jQuery File Tree comes with a handful of serverside connector scripts that are used to read the file system on your server and return data to the clientside script via AJAX. The default connector script isjqueryFileTree.php. You can use a connector script for another language by setting thescriptparameter to the location of the script you want to use (see Configuring the File Tree). Alternatively, you can build a custom connector script to extend the functionality of jQuery File Tree to better suit your needs (see Custom Connector Scripts).

Connector scripts for the following languages are included in the download:

PHP by Cory S.N. LaViska
ASP (VBS) by Chazzuka
ASP.NET (C#) by Andrew Sweeny
ColdFusion by Tjarko Rikkerink
JSP by Joshua Gould
Lasso by Marc Sabourdin
Lasso by Jason Huck
Perl by Oleg Burlaca
Python/Django by Martin Skou
Ruby by Erik Lax

The connector scripts provided with jQuery File Tree are only designed to read information from a specified root folder. Although this is typically harmless, there exists a potential for malicious individuals to be able to view your entire directory structure by spoofing therootparameter. It is highly recommended that you add some form of check to your connector script to verify the path being scanned is a path that you want to allow visitors to see.

Custom Connector Scripts
------------------------

You can create a custom connector script to extend the functionality of the file tree. The easiest way to do this is probably by modifying one of the scripts supplied in the download. If you want to start from scratch, your script should accept one POST variable (dir) and output an unsorted list in the following format:

    <ul class="jqueryFileTree" style="display: none;">
        <li class="directory collapsed"><a href="#" rel="/this/folder/">Folder Name</a></li>
        (additional folders here)
        <li class="file ext_txt"><a href="#" rel="/this/folder/filename.txt">filename.txt</a></li>
        (additional files here)
    </ul>

Note that the corresponding file extension should be written as a class of the li element, prefixed with ext_. (The prefix is used to prevent invalid class names for file extensions that begin with non-alpha characters.)

Licensing & Terms of Use
------------------------

This plugin is dual-licensed under the GNU General Public License and the MIT License and is copyright 2008 A Beautiful Site, LLC.

Special Thanks
--------------

A special thanks goes out to FAMFAMFAM for their excellent Silk Icon Set.
Originally from http://www.abeautifulsite.net/blog/2008/03/jquery-file-tree/