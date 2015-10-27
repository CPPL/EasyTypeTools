#EasyTypeTools Plugin

A simple Joomla plugin that adds:
 
 - Font Awesome to your Joomla Website
 - Keyboard CSS styles to show \<kbd>

##Basic Usage Steps
  1. Install via the standard Joomla extension manager and enable it.
  2. Enable the plugin.
  3. _For Pro users_ choose the CDN or to serve it locally. 
  4. _There is no step 4…_
  
##Options

EasyTypeTools Pro can load the Font Awesome kit from the official CDN _or_ from your local server.

EasyTypeTools Pro will also loads the non-minimised version when Joomla's Debug is enabled, allowing for easy resolution of CSS issues when using Font Awesome.

##Example Usage
###Font Awesome
Font Awesome 4.4.0 has [550 icons for you to choose from](http://fontawesome.io/icons/), here's a few examples of how to use them.

Add an empty "battery" icon to text:

```
<p>I'm feeling completely flat… <i class="fa fa-battery-empty"></i></p>
```

Add an Amazon button

```
<a href="https://amazon.com" target="_blank">  
    <span class="btn btn-large">  
        <i class="fa fa-amazon"></i>  
    </span>  
</a>  
```
###Keyboard Key Styles
The \<kbd>\</kbd> element represents user input (typically keyboard input, although it may also be used to represent other menu commands) — you can [read more here](http://www.w3.org/TR/html5/text-level-semantics.html#the-kbd-element).

When `Keyboard CSS` is swithed **On** then \<kbd> elements will be wrapped in borders to simulate keys on a keyboard. Something like this:
![\<KBD> Elements Styled as Keys by CSS](Support%20Files/KBD_styled_as_Keys_by_CSS.png)

When `Keyboard CSS` is enabled, EasyTypeTools loads the relevant CSS into your Joomla page automatically.

####Command Example
```
<p>To copy the selected text type <kdb><kbd>command ⌘</kbd>-<kbd>C</kbd></kbd> (or <kdb><kbd>CTRL</kbd>-<kbd>C</kbd></kbd> on Windows).</p>
```

####Menu Example
```
<p>To open Joomla's Article Manager select  <kdb><kbd>Content | Articles</kbd></kbd> from the menu bar.</p>
```

##Notes
 - This plugin only supports Joomla 3. 
 - This plugin requires PHP 5.4 or higher.
