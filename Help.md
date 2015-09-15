
# Humm PHP help

## Index of contents

1.  [What do you need](#whatDoYouNeed)

2.  [Optional configuration](#optionalConfig)

    1.  [Language](#languageConfig)
    2.  [Errors report](#errorsConfig)
    3.  [Active plugins](#pluginsConfig)
    4.  [Database DSN](#databaseConfig)

3.  [Adding site views](#addingSiteViews)

    1.  [Views URLs](#viewsUrls)
    2.  [Views URLs (rewrite)](#viewsUrlsRewrite)
    3.  [Views files](#viewsFiles)
    4.  [Views helpers](#viewsHelpers)
    5.  [Views directories](#viewsDirectories)
    6.  [Views variables](#viewsVariables)
    7.  [Views classes](#viewsClasses)
    8.  [Shared views](#sharedViews)

4.  [Site translation](#siteTranslation)
    1.  [Short i18n functions](#shortI18nFuncs)
    2.  [Standard PO files](#standardPOFiles)

5.  [Running multisites](#runningMultisites)

    1.  [Sites directories](#sitesDirectories)
    2.  [Sites shared directories](#sitesSharedDirectories)
    3.  [Server configuration](#sitesServerConfig)

6.  [Humm PHP plugins](#hummPlugins)

    1.  [Plugin filters](#pluginFilters)
        *   [DATABASE_SQL](#DATABASE_SQL)
        *   [VIEW_TEMPLATE](#VIEW_TEMPLATE)
        *   [BUFFER_OUTPUT](#BUFFER_OUTPUT)

    2.  [Plugin actions](#pluginActions)
        *   [PLUGINS_LOADED](#PLUGINS_LOADED)
        *   [CHECK_REQUERIMENTS](#CHECK_REQUERIMENTS)
        *   [DATABASE_CONNECTED](#DATABASE_CONNECTED)
        *   [SCRIPT_SHUTDOWN](#SCRIPT_SHUTDOWN)

7.  [Recommended tools](#recommendedTools)


## What do you need

In order to use **Humm PHP** for your sites you need a web server which run PHP 5.4 or later. You no need to perform any installation process and all the configuration options are optionals, so your copy of **Humm PHP** must works like a charm just when copy the distribution files into your web server. However probably you want to take a look at the optional configuration in order to customize your **Humm PHP** copy.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Optional configuration

Here you can learn how to use the optional configuration in order to customize your **Humm PHP** copy. For example if you specify the appropiate database DSN option, then **Humm PHP** automatically connect with the specified database and put it available to be use in your site. Also you can set the default site language, the errors report level, etc.

**Humm PHP** provides you with a configuration file which can be found in:

<pre>/Humm/Sites/Main/Config/Config.php (Config for the main or default site)
</pre>

Open "Config.php" with your favorite text editor and set the configuration constants which that file defines. Since **Humm PHP** support multisites, you can set diferent configuration options per every site, just using the appropiate "Config.php" file from every site directory. See below in this documentation how to setup **Humm PHP** to run various sites a the same time.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Language

Open your site "Config.php" and locate the "HUMM_LANGUAGE" constant. You can define this constant with a valid language code (from the ISO 639-1 list) to tell **Humm PHP** what language you want to use. A valid language code implied that the appropiate MO file is available in your site. See below in this documentation how you can translate your sites using standard and well know PO files.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Errors report

Open your site "Config.php" and locate the "HUMM_SHOW_ERRORS" constant. You can define this constant with a boolean value, "True" or "False", in order to establish the **Humm PHP** errors report level. This configuration determine if **Humm PHP** print out possible errors information or must to hide it for security purposes.

The default value for this configuration option is "True", which means **Humm PHP** print out information about any possible error. Even when you change this configuration option to "False" **Humm PHP** print out the errors information, BUT ONLY IF runs in a local server, AND NEVER in a remote web server. The recommended value for this constant is "True" while debug the application, and "False" when this are placed in the production server.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Active plugins

Open your site "Config.php" and locate the "HUMM_ACTIVE_PLUGINS" constant. You can define this constant with comma separated values which correspond with plugin dir/names in order to active the specified plugins in your site. For example, supose you have two plugins in your **Humm PHP** plugins directory: "MyPlugin" and "OtherPlugin".

Now you can maintain deactivated these plugins in your site by let the "HUMM_ACTIVE_PLUGINS" constant empty. If you want to active "MyPlugin" just define the constant with "MyPlugin" value. If you want to active both plugins define the constant as: "MyPlugin,OtherPlugin". By default this constant is empty, that is, no one plugin is activated.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Database DSN

Open your site "Config.php" and locate the "HUMM_DATABASE_DSN" constant. You can define this constant with a valid database connection string (DSN) and **Humm PHP** automatically establish the connection with the database and therefore allows you to works with the database. If you let this configuration option empty **Humm PHP** simply understand that your site do not need any database connection.

Since **Humm PHP** use PHP PDO to works with databases, your DSN can specify a valid database string for any of the database drivers supported by PHP PDO: MySQL, FireBird, PostgreSQL, SQLite and many more. If finally you decide to connect with a database, do not forget to provide a valid database user name and password using the appropiate configuration constants: "HUMM_DATABASE_USER" and "HUMM_DATABASE_PASS".

[Back to the index](#documentsIndex "Click to back to the documents index")


## Adding site views

**Humm PHP** based their work in the concept of site views. A site view is a PHP file which the system require on the appropiate user request. Every user request is made with an URL, which correspond with one file view. An example can be this "Documents" view. Yes; this site is of course managed by **Humm PHP** and you are now read the "Documents" view contents.

A **Humm PHP** site must have one mandatory view: the Home view, which is required everytime the user request the site home and also if the requested view are not found. The Home view is the only mandatory view and the system inform with an error if do not exists. Then you can add to your site unlimited views in order to provide the appropiate contents to your visitors.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Views URLs

Every site view correspond with the appropiate request URL. Or in the same way every URL correspond with the appropiate view. **Humm PHP** do not use any MOD REWRITE to maintain it server independent, however, provides with user friendly URLs like this:

<pre>http://www.yoursite.com/

http://www.yoursite.com/?home

http://www.yoursite.com/?contact

http://www.yoursite.com/?search
</pre>

The first and second URLs correspond with the "Home" view. The second correspond with a "Contact" view and the third correspond with a "Search" view. The system is responsible to require the appropiate view per user requests and your responsibility is to provided the appropiate views files and optionally views associated PHP classes.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Views URLs (rewrite)

Certainly Humm PHP do not need any server rewrite module in order to work with friendly URLs, as you can see above. However, if you want to use a rewrite module, can do it without problems. Simply put an ".htaccess" file like this in your Humm PHP installation root directory:

<pre>RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^.*$ index.php
</pre>

As you can see the point is that every non existing file request must end in the "index.php" file. The above file sample can be used in Apache server, but you can write something similar using the appropiate syntax for your server. Anyway, if you add (remember this is optional) a file like the above, then you can use URLs like this:

<pre>http://www.yoursite.com/

http://www.yoursite.com/home

http://www.yoursite.com/contact

http://www.yoursite.com/search
</pre>

Note how we do not need the "?" symbol into the URLs. In fact Humm PHP works in the same way if you use a rewrite module or not, so you can doing whatever you wanted in this aspect.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Views files

**Humm PHP** is distributed with a default "Home" view which of course you can modify it to suit your needs. The "Home" view file is placed under your sites directories in:

<pre>/Humm/Sites/Main/Views/
</pre>

The above views directory path is intended for the main site. Remember you can run various sites using the same **Humm PHP** base code, so you can found your sites views in the appropiate sites directories:

<pre>/Humm/Sites/Main/Views/

/Humm/Sites/Othersite/Views/

/Humm/Sites/Anothersite/Views/
</pre>

Into the views directories you can place your views files, which in fact consists in simply and powerfull PHP files. So yes, you can found in your site views directory a file named "Home.php", which contain the contents to be shows when the user request the site home. Ok. Place now a file named "Contact.php" and another file more named "Search.php". Tachan! You have now another two views in your site, which correspond with this request URLs:

<pre>http://www.yoursite.com/?contact

http://www.yoursite.com/?search
</pre>

On such URLs the system automatically requires the appropiate "Contact.php" or "Search.php" views files. Note we name our views with a capitalized name: this is mandatory by convention and therefore a "contact.php" or "search.php" cannot be take as views files.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Views helpers

There two types of views in **Humm PHP** and your sites: the main views and the helpers views. The main views correspond with the appropiate URL argument or user request. The helper views are intended to be used by other views, included helpers itself. The helpers views must be stored into the subdirectory "Helpers" under the "Views" directory.

Every PHP file in such directory are considered views helpers and can be displayed by others views using the "displayView" method of your view HtmlTemplate object. Just imagine something like that in your "Home.php" view code:

<pre>$this->displayView('MyHeader');
This is the content of my Home.php view

$this->displayView('MyFooter');
</pre>

As you can see above, we use the "$this" view variable to access to the view HtmlTemplate object. What we do is to call the "displayView" method, indicating the name of our required helper. In this case we supose that two helpers exists: "MyHeader.php" and "MyFooter.php", but note that we can ommit the ".php" extensions when display views using the "displayView" method.

The views helpers provide us with the right way to reuse code in our site views. So we can reuse the same "MyHelper" helper in every "view" of our site, and therefore we no need to write the same code over and over again in every site view.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Views directories

Under your site views directory you can found by default certain subdirectories. This subdirectories are included by default to place more or less common site files. Also, you can access to these views directories URLs using the appropiate views variables (see below) so I recommend you to use these directories instead others. Below you can view a site views directory tree:

<pre>/Humm/Sites/Main/
  /Files/
  /Helpers/
  /Images/
  /Scripts/
  /Styles/
</pre>

By default **Humm PHP** include in your views directory these subdirectories: Files, Helpers, Images, Scripts and Styles. Is easy to view that you can put your site CSS style files in the Styles directory, your site Javascript files in the Scripts directory, etc. The Files directory is intended to put downlable files like ZIP or PDF files, for example

[Back to the index](#documentsIndex "Click to back to the documents index")


## Views variables

**Humm PHP** set in all site views certain useful PHP variables which contain general information that you can use in your views. This information is available using the appropiate **Humm PHP** system classes, however, they are added into the views directly like template variables for quick usage. The default site views variables are:

$this

This variable store an instance of the view HtmlTemplate object.

$siteLanguage

This variable store your site current language code.

$siteLanguages

This variable store codes/names of your site languages.

$siteLanguageDir

This variable store "ltr" or "rtl", depend on your site language direction.

$viewName

This variable store the name of the current site view.

$siteView

This variable store an instance of the current view class.

$sharedView

This variable store an instance of the optional shared view class.

$requestUri

This variable store the current request URI.

$siteUrl

This variable store your site root or home URL.

$viewsUrl

This variable store your site views directory URL.

$viewsFilesUrl

This variable store your site views files directory URL.

$viewsImagesUrl

This variable store your site views images directory URL.

$viewsStylesUrl

This variable store your site views styles directory URL.

$viewsScriptsUrl

This variable store your site views scripts directory URL.

$sharedViewsUrl

This variable store your sites shared views directory URL.

$sharedViewsFilesUrl

This variable store your sites shared views files directory URL.

$sharedViewsImagesUrl

This variable store your sites shared views images directory URL.

$sharedViewsStylesUrl

This variable store your sites shared views styles directory URL.

$sharedViewsScriptsUrl

This variable store your sites shared views scripts directory URL.

$hummVersion

This variable store your **Humm PHP** copy version.

$hummRelease

This variable store your **Humm PHP** copy release date.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Views classes

Remember: a view file is a simply but powerfull PHP file intended to print out the appropiate site contents. In every view you can use HTML, CSS, JavaScript and powerful PHP code to present the contents to your site visitors. Into a view file **Humm PHP** provides with various PHP variables containing information like the site language, the current language direction, various site URLs ready to use, etc.

Ok. You can use the view file to provide your site contents, so what is a view class and when use it? A view class is an optional PHP class derived from the base "HummView" class which you can implement to be associated with a site file view. This mean that such class are setup before a view file is required, and therefore you can provide the file view with new PHP variables to be ready to use.

Supose you need to retrieve certain records from a database to be print out from the "Search.php" file view. Instead of codify the appropiate code into the "Search.php" file, your database logic can reside in the view associated class, so you retrieve the records from the database and put it into a "$SearchResults" variable, for example. Then you can use this variable from the view file in an comfortable way.

Some conventions about view classes. Views classes need to be implemented into a file under the site classes directory, for example:

<pre>/Humm/Sites/Main/Classes/
</pre>

Under such directory you can place your view class. For example, supose we want to prepare views class for our site "Contact.php" and "Search.php" views files, then we prepare these class files:

<pre>/Humm/Sites/Main/Classes/ContactView.php

/Humm/Sites/Main/Classes/SearchView.php
</pre>

Note the capitalized classes and file names. This is mandatory and classes like below are not considered valid view classes:

<pre>/Humm/Sites/Main/Classes/contactview.php

/Humm/Sites/Main/Classes/searchView.php
</pre>

Then your views classes must be derived from the system "HummView" base class. This is an example of the "ContactView" class containing the constructor method, which can be used to provide new PHP variables to the views file template:

<pre>namespace Humm\Sites\Main\Classes;

use
  \Humm\System\Classes\HummView,
  \Humm\System\Classes\HtmlTemplate;

class ContactView extends HummView
{
  public function __construct(HtmlTemplate $template)
  {
    parent::__construct($template);
    $template->myNewVariable = 'Variable content';
    $template->anotherVariable = 'Variable content';
    // and so on...
  }
</pre>

That\'s all! Your "ContactView" class is ready to use and the system setup it just before the correspond view file "Contact.php" are required, so you can use in such file the new template variables added by the "ContactView" class. Finally I recommend you to take a look at the "HomeView" class provided by **Humm PHP** along the "Home.php" view file included by the Humm PHP distribution. This "HomeView" class shows how to change the site user language by requests, so you can imagine that view classes can expand the views files capabilities in lot of ways.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Shared views

Above we talking about optional site view classes, which offers the hability (between other things) to provide with variables on the associated site views. Is a common issue the need to use certain variables in various site views. Of course we can use every site views class to setup this variables, but, **Humm PHP** provide you with a more convenient way to do this.

Supose you have two site views: "Home.php" and "Contact.php". You can implement (optionally) two views classes: "HomeView" and "ContactView", which are setup just before the associated site views ("Home.php" and "Contact.php") are displayed. Now supose you want to use in both views a PHP variable named "$copyright". You can create two views classes or just create one "SharedView" class.

A "SharedView" is optional and can reside in your site classes directory. Must follow all convenitions and must be inherited from the "HummView" class, just like any other site views class. However, the optional "SharedView" class are setup by the system just before display any site view. So you can use the "SharedView" to setup stuff which can be used across various site views.

For more information you can take a look at the real sample included by the Humm PHP site sample, which implement the optional "SharedView" class.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Site translation

All **Humm PHP** views and plugins are ready to be translated in a very easy way. **Humm PHP** make this possible by the use of standard PO files which you can edit using, for example, the PO Edit program. The only thing you need to do is to use the appropiate I18n functions in your views and plugins, instead of the use of hard writen strings. So even when you do not plain to translate your site, is a good idea to use the refered functions instead of hard strings, because in this way your site can be easy translated when you need.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Short i18n functions

**Humm PHP** provides you with some convenient i18n functions in order to prepare your strings in order to be translated. Declared into the global PHP namespace this functions are:

<pre>The t() function, which return an string translation or the original one.
</pre>

<pre>The e() function, which directly print an string translation or the original one.
</pre>

<pre>The n() function, which return the right singular or plural translated version.
</pre>

<pre>The ne() function, which directly print the right singular or plural translated version.
</pre>

Supose you want to shown to your site visitors the message "Hello world!" from one of your site views. May you think in write something like that into the view file:

<pre>Hello world!
</pre>

Instead of write hard strings into your site views, you can use the appropiate i18n function in someway like this:

Just doing this your "Hello world!" are ready to be translated. Your site PO files scan the code for this kind of strings and allows you to provide the appropiate translation. Then **Humm PHP** automatically load the neccesary MO file (compiled PO file) in order to make their messages availables and therefore use it for strings tranlations purposes. I carefully recommend you use the short i18n functions instead of hard strings in your sites.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Standard PO files

Every site and plugin directory can provide a "Locale" directory in which **Humm PHP** can locate the appropiate site and plugin MO files (which are compiled PO files). Every MO file must be placed into a "Locale" subdirectory, and this subdirectory and the MO file itself must be named by the language translation which the included. For example, take a look at this MO file paths:

<pre>/Humm/Sites/Main/Locale/es/es.mo

/Humm/Sites/Main/Plugins/SamplePlugin/Locale/es/es.mo
</pre>

Above you can view two MO files which correspond with the main site and certain sample plugin. I recommend you to use one of the ISO 639-1 language codes for the name of your "Locale" language directories and the MO file name. **Humm PHP** use the ISO 639-1 list to, for example, to provide the right language name from a language code. Sites nor plugins not need to worry about this MO files, but the system is responsible to automatically load it in order to be availables.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Running multisites

**Humm PHP** allows you to manage multiple sites using the same base code. This is extremelly easy and the only which you need is to prepare one site directory for every site you want to run. On the other hand some server side configuration is also required: basically we need to point our differents domains to be use the same **Humm PHP** directory in order to serve their contents. Doing this **Humm PHP** automatically recognize what site contents are required and provided the user with the appropiate response.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Sites directories

Familiarize yourself with the Humm directories tree:

<pre>/Humm/
  /Sites/
  /System/
  /Plugins/
</pre>

**Humm PHP** is divided in three directories named "System", "Plugins" and "Sites". All your sites stuff resides into the "Sites" directory like in this tree:

<pre>/Humm/Sites/
  /Main/
  /Shared/
  /Othersite/
  /Anothersite/
</pre>

Every specific "Sites" subdirectory represent a site ready to be managed by **Humm PHP**. You no need to create the sites "Main" directory: this contains the default site stuff. Also you no need to create the "Shared" directory, which is intended to place stuff to be shared along all other sites. The key for run multisites are in the other sites subdirectories, which need to be named like the server name you want to use for every site. This sites subdirectories neccesary be named in a capitalized way, the first letter must be in upper case instead all others remains in lower case.

Supose you have three domains and you want to share the same **Humm PHP** copy in order to run it. You have for example this tree domains:

<pre>http://www.peterparkerhome.com/

http://www.peterparkerbusiness.com/

http://www.peterparkerrocks.com/
</pre>

Supose now your **Humm PHP** resides into the first domain, then you need to have exactly this subdirectories into your **Humm PHP** Sites directory:

<pre>/Humm/Sites/
  /Main/
  /Peterparkerbusiness/
  /Peterparkerrocks/
</pre>

In this case the "Main" directory contains the stuff for "www.peterparkerhome.com". The "Peterparkerbusiness" contains the stuff for "www.peterparkerbusiness.com" and finally the "Peterparkerrocks" directory correspond with the "www.peterparkerrocks.com" domain. There is no limit in the number of sites which **Humm PHP** can run.

Note that Humm PHP also supports multisites with subdomain URLs. Then supose this possible URLs for your sites:

<pre>http://www.home.peterparker.com/

http://www.business.peterparker.com/
</pre>

For these URLs you must provide sites directories like these:

<pre>/Humm/Sites/
  /Main/
  /HomePeterparker/
  /BusinessPeterparker/
</pre>

A particular case can happend if you want to use numeric domains or domains that start with one or more numbers. Since PHP do not allow identifiers (like in PHP namespaces) starting with a number or just whole numbers, **Humm PHP** handle the possible problems by converting these numeric domains into string representations. Then supose you want to use domains like below:

<pre>http://www.peter.com/

http://www.1001.com/

http://www.10abc.com/
</pre>

For these URLs you must provide sites directories like these:

<pre>/Humm/Sites/
  /Main/
  /Onzezeon/
  /Onzeabc/
</pre>

Note the numbers conversion that **Humm PHP** does, by using the first two letters of the english numbers names:

*   0 = ze
*   1 = on
*   2 = tw
*   3 = th
*   4 = fo
*   5 = fi
*   6 = si
*   7 = se
*   8 = ei
*   9 = ni

Note also that not all domains which contain numbers must be converted into strings, since the problems come when a domain start with a number or they are an entire number. For example:

<pre>http://www.peter.com/

http://www.abc10.com/
</pre>

These URLs you must provide sites directories like these:

<pre>/Humm/Sites/
  /Main/
  /Abc10/
</pre>

Just provide the appropiate "Sites" subdirectory corresponding with the appropiate domain or subdomain and that\'s all, **Humm PHP** do the rest. Just remember the probably most way to create new sites directories: just replicate the "Main" site directory from a clean **Humm PHP**, rename the directory name acordingly with the new domain or subdomain and begin to modify the site contents to suit your needs.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Sites shared directories

**Humm PHP** allow you to run multiple sites using the same base code, and, of course you can easy share resources (like views, helpers, styles, scripts, etc.) between the managed **Humm PHP** sites. To do this **Humm PHP** provide you the optional Sites shared directory. The sites shared directory follow the same directory tree than another site directory, in the sense that you can found the appropiate views, helpers, scripts, styles, etc.

The **Humm PHP** site view templates contains usefull variables to use the resources (mainly files, scripts and styles) placed into the sites shared directory. And **Humm PHP** take care automatically about the possible views and helpers placed in the shared directory too. If the user requested view is located into the sites shared directory this take precedence and is required in order to be used. The same thing can be said about any views helpers placed into the sites shared directory.' ) ?>

Also **Humm PHP** is responsible to automatically load the possible available text domain of the sites shared directory. This means that you no need to worry about what language need to use or is currently established. You can write views and helpers into the site shared directory as easy than you can does in any other **Humm PHP** site directory. You can also act over the user requested view and, for example, place variables into it, in a way that can be later used by any other site view or view helper.' ) ?>

[Back to the index](#documentsIndex "Click to back to the documents index")


## Server configuration

Once you prepare your appropiate sites directories, you need a way to tell your servers to point every appropiate domains to the same **Humm PHP** copy. How exactly doing this depend on your server administrator panel allows you to set the domains root directories. Ok. The only thing you need to do is to set this domains root directories path to point at the **Humm PHP** copy.

For example, remember our three sample sites:

<pre>http://www.peterparkerhome.com/

http://www.peterparkerbusiness.com/

http://www.peterparkerrocks.com/
</pre>

Now take a look at this domains possible root directories:

<pre>http://www.peterparkerhome.com/
/public_html/peterparkerhome.com/

http://www.peterparkerbusiness.com/
/public_html/peterparkerhome.com/

http://www.peterparkerrocks.com/
/public_html/peterparkerhome.com/
</pre>

Yes. We need to configure the domains root directories to use exactly the same one. Then you only need to copy the **Humm PHP** files into the first root directory, since the other domains point to this directory too. That\'s all! Doing this your **Humm PHP** copy can runs multiple websites and is the responsible to use the appropiate contents for every site.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Humm PHP plugins

**Humm PHP** plugins are PHP classes derived from the base class "HummPlugin" and placed into the **Humm PHP** "Plugins" directory:

<pre>\Humm\Plugins\
</pre>

You need to follow certain **Humm PHP** conventions. For example, supose you want to create a plugin named "MyPlugin", then you place the class in this path:

<pre>\Humm\Plugins\MyPlugin\MyPlugin.php
</pre>

Next, your "MyPlugin.php" file must declare a class like this -note how the PHP namespace include the plugin directory name too:

<pre>namespace Humm\Plugins\MyPlugin;

use
  \Humm\System\Classes\HummPlugin;

class MyPlugin extends HummPlugin {}
</pre>

Ant that\'s all. Doing this your plugin is ready to be loaded by **Humm PHP** along with the other possible plugins. Also every plugin directory can (optionally but recommended) have various subdirectories:

<pre>/MyPlugin/
  /Classes/
  /Locale/
      /es/
      /fr/
  /Views/
      /Files/
      /Scripts/
      /Images/
      /Styles/
      /Helpers/
</pre>

The system class "HummPlugin" offers you various methods in order to get the URLs and directory paths of such directories. On the other hand, remember you can (and is recommended) use in your plugins the I18n short functions in order to get your plugin strings translated in differents languages. In fact you can use the "Locale" directory to put languages subdirectories, just like in the site directory: **Humm PHP** automatically load the appropiate MO file from your plugin "Locale" directory and put the translated strings available to be used.

Finally let me to say that **Humm PHP** is distributed with a sample plugin, which you can use to take as a template for your own plugins or just to learn how a **Humm PHP** plugin is implemented, what directories use, where to place the language files, etc.

Also note that the sytem automatically add for you the plugin views and helpers directories to the site template pahts. This means that you can have a "MyPluginView.pnp" file into the plugin views directory. Then you can display your plugin view into a site view using the "displayView" method of the HtmlTemplate object:

<pre>$this->displayView('MyHeader');

This is the content of my Home.php view

$this->displayView('MyPluginView');

$this->displayView('MyFooter');
</pre>

[Back to the index](#documentsIndex "Click to back to the documents index")


## Plugin filters

If the plugins only can act like other site classes they do not have too much sense. On the contrary, every **Humm PHP** plugin is informed by the system in certain circumstances, and, for example, provides a way to filter certain content before are print out to the user. In order to be notified by the system when certain filter can be used, your plugin class need to implement the "applyFilter" method in this way:

<pre>namespace Humm\Plugins\Sample;

use
  \Humm\System\Classes\HummPlugin,
  \Humm\System\Classes\FilterArguments;

class Sample extends HummPlugin
{
  public function applyFilter(FilterArguments $arguments)
  {
    // Filtered or not
    return $arguments->content;
  }
}
</pre>

As you can see, every filter provide an "FilterArguments" argument, which is an object that, at the least, count with two properties: "filter" and "content". The "filter" contains the ID of the filter being executed, and, the "content" store the content which can be filter. This "content" relies on the filter ID, and can be an string, an object, an array or whatever else. The filter arguments also can contain a "bundle" property, which also can include any other information, depends on the appropiate filter.

One important thing you need to take into consideration when implement the "applyFilter" method in your plugins, is that this method ALWAYS need to return the "$arguments->content" value. So, you can apply or not certain filter to the contents, but, you always need to return the content, because in other case you broke the filter chain. For example, take a look at the below implementatio of the "applyFilter" method in a real scenario:

<pre>namespace Humm\Plugins\Sample;

use
  \Humm\System\Classes\HummPlugin,
  \Humm\System\Classes\FilterArguments;

class Sample extends HummPlugin
{
  public function applyFilter(FilterArguments $arguments)
  {
    switch ($arguments->filter) {
      case PluginFilters::BUFFER_OUTPUT:
        $arguments->content = \strtoupper($arguments->content);
        break;
    }

    // Filtered or not
    return $arguments->content;
  }
}
</pre>

As you can see, we want to react on the "BUFFER_OUTPUT" filter ID. This filter content is an string, and we want to put it in uppercase. But note how we act over the "content" variable, and the "applyFilter" method always return such variable, for example, when a filter ID is not what we are looking for.

[Back to the index](#documentsIndex "Click to back to the documents index")


## DATABASE_SQL

This filter occur before a database SQL statement must to be executed. The intention of this filter is to translate SQL statments into specific database drivers SQL statements. Since **Humm PHP** use PDO to connect with database, it\'s possible to use various database drivers. Then a plugin can be made in order to translate say "general" SQL statement into specific database drivers SQL statements.

This filter "content" is the SQL statement to be executed. The filter "bundle" contains an array with the specified SQL stament options. The plugin is responsible to return such SQL statement filter or not, in order to do not broken the chain.

[Back to the index](#documentsIndex "Click to back to the documents index")


## VIEW_TEMPLATE

This filter occur before a site view must to be displayed or in any case when the system preparing the site view HtmlTemplate object with certain default variables. The plugin can use this filter in order to put into the HtmlTemplate object new variables, ready to be used later into the site views.

This filter "content" is an HtmlTemplate object which the plugin can use in order to modify or add new variables in order to put availables into the site views. The plugin is responsible to return in this filter the same content, that is, the HtmlTemplate object, filtered or not, in order to do not broken the chain. This is an implementation sample of this filter:

<pre>public function applyFilter(FilterArguments $arguments)
{
  switch ($arguments->filter) {
    case PluginFilters::VIEW_TEMPLATE:
      $arguments->content->myNewVariable = 'Variable content';
      $arguments->content->otherUsefulVar = 'Variable content';
      break;
  }

  // Filtered or not
  return $arguments->content;
}
</pre>

In the above code you assign two new variables ("$myNewVariable" and "$otherUsefulVar") to the current site view HtmlTemplate object. These variables become availables into the site view ready to be used.

[Back to the index](#documentsIndex "Click to back to the documents index")


## BUFFER_OUTPUT

This filter occur before the user response output buffer must be printed. In other words, after the system prepare the appropiate response, the plugins allows to filter such response in some useful way.

This filter "content" is the entire output buffer just before to be print out and the plugin is responsible to return such output buffer filter or not, in order to do not broken the chain.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Plugin actions

The plugins actions allows you to react when certain events occur in the **Humm PHP** system. For example, you can react when the plugins are loaded, when the system and plugins requeriments need to be checked, when the script shutdown occur, etc., etc. Every **Humm PHP** plugin must implement a public "execAction" method in the plugin class, and this method is called from the system when certain event or action occur. Here is a sample of how to implement the "execAction" method in a **Humm PHP** plugin:

<pre>namespace Humm\Plugins\Sample;

use
  \Humm\System\Classes\HummPlugin,
  \Humm\System\Classes\ActionArguments;

class Sample extends HummPlugin
{
  public function execAction(ActionArguments $arguments)
  {

  }
}
</pre>

Similar to plugin filters, actions provides you in the "argument", an object of the "ActionArguments" class. This object contain at the least one property: "action", which contains the action ID being executed. The action arguments also can contain a "bundle" property, which also can include any other information, depends on the appropiate action. Unlike "applyFilter", the "execAction" method do not need in principle to return nothing. However, every action specify what the system expect to occur in the "execAction" method. Take a look at a sample implementation of the "execAction" method:

<pre>namespace Humm\Plugins\Sample;

use
  \Humm\System\Classes\HummPlugin,
  \Humm\System\Classes\ActionArguments;

class Sample extends HummPlugin
{
  public function execAction(ActionArguments $arguments)
  {
    switch ($arguments->action) {
      case PluginActions::PLUGINS_LOADED:
        // The plugins are loaded. Do something useful.
        break;
    }
  }
}
</pre>

[Back to the index](#documentsIndex "Click to back to the documents index")


## PLUGINS_LOADED

This action occur just after **Humm PHP** are loaded all the available plugins. You can use this action to do something useful at such time.

[Back to the index](#documentsIndex "Click to back to the documents index")


## CHECK_REQUERIMENTS

This action is executed just after the system check their requeriments. If a plugin need certain requeriments can use this action in order to check it. If your requeriments fail, what you need to do is to use the "trigger_error" PHP function, and let the system to shows such errors in the standard way. Do not print out nothing in this action in order to inform the user about the requeriments fail: instead use the "trigger_error" function and let the system do the rest.

[Back to the index](#documentsIndex "Click to back to the documents index")


## DATABASE_CONNECTED

This action is executed just after a database connection is performed. **Humm PHP** do not relies on any database, but, the user can decide to configure it to connect with someone. If then, the plugins are notified with this action when a database connection has been established. Remember **Humm PHP** provides with the "Database" system class, which allows you to works with databases in a supereasy way.

[Back to the index](#documentsIndex "Click to back to the documents index")


## SCRIPT_SHUTDOWN

**Humm PHP** register the appropiate PHP function in order to be notified when the script shutdown occur. This action is executed at such time, and the plugins can use it in order to make something useful at that time.

[Back to the index](#documentsIndex "Click to back to the documents index")


## Recommended tools

I recommend you some tools in order to work with your **Humm PHP** copy. For debugging purposes I choose the [XAMPP project](http://www.apachefriends.org/ "Click here to open the XAMPP project website"), which can setup an Apache + PHP environment in seconds. For manage and edition purposes I personally use the [NetBeans for PHP](http://netbeans.org/features/php/ "Click here to open the NetBeans project website") program, probably the best code IDE for PHP, HTML, CSS, JavaScript and more. And for PO files (translation file) edition I carefully recommend the [PO Edit program](http://www.poedit.net/ "Click here to open the PO Edit website"), which you can found ready to use in various operating systems.

---

(C) 2015 Humm PHP by David Esperalta - http://www.davidesperalta.com/
