=== Multi Purpose Mail Form ===
Contributors: mahlamusa
Donate link: http://example.com/
Tags: contact form, custom forms, form generator, form creator, unlimited forms, google captcha, recaptcha, country list, subscription form, email form, form, custom, email, contact
Requires at least: 4.5
Tested up to: 4.7.3
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create unlimited forms with unlimited fields with ease. Includes lots of predeifined fields.

== Description ==

The Multi Purpose Mail Form wordpress plugin allows you to add a custom form to your website to allow your visitors 
to send emails to you directly from your website or blog. The Multi Purpose Mail Form also includes an email subscription 
form that you can use to capture visitors' email addresses for service updates or newsletters. Just paste [mpmf] anywhere 
in your post or page to display the contact form or [subscribe] to display the subscription form, or [mpmfcustom id="ID"]-Message/Note-[/mpmfcustom] for custom forms. This wordpress plugin 
sends all data submitted via your website or blog to your email address.

* Create custom forms with any number of fields
* Use the default contact and subscription form
* Manage your custom forms - edit, update, delete forms
* Preview your custom forms before publishing
* Insert list of countries in your form

== Installation ==

This section describes how to install the plugin and get it working.

1. Unzip and upload `multi-purpose-mail-form` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. 
 * Place [mpmf] for the default contact form or [subscribe] for the default subscription form anywhere on your page or post if you are a non-developer
 * Place [mpmfcustom id="ID"]-Custom Message-[/mpmfcustom] for the custom contact form anywhere in plugins or posts - ID is the form's id available on your admin
 * Place `<?php mpmf_default_form() ?>` for the default contact form or `<?php echo mpmf_subscribe(); ?>` for the default subscription form
 * Optional: link to us by placing [supportlink] in a page or post, or `<?php echo link_to_us(); ?>` on your template
4. For custom forms, first look for the form name and form id of the form you want to use, you can find these by clicking on 'Manage Forms' or 'Preview Forms' under 'MPMF' on your admin side menu, your only need the 'Form Id' to use the form as follows<br />
<code>[mpmfcustom id="Form Id"]-Custom Message-[/mpmfcustom]</code> where "Form Id" is a number - the id of the form you want to use and -Custom Message- is any message or writing you want to appera above the form on your page or post.
5. Use wordpress 

== Frequently Asked Questions ==

= Do you have any online videos for the plugin? =

Visit our [YouTube Channel](https://www.youtube.com/user/mahlamusa/ "YouTube Channel") for up to date video tutorials and plugin documentation.

= How to create a custom form? =

Go to your admin, under MPMF, To create a form, just enter its name in the text box label "Form Name" under "New Form" on the Main page, then click "Create". On the same page

= How to add fields to my newly created form? =

Now you can start adding fields by clicking on "Edit Fields" next to the form you want to edit. You will see the list of fields you can add to your form in the form of buttons you can click on the right sidebar of the page. You will also see a live preview of the form after adding a field to it.

= How to update Form / Field details? =

On the main page accessible by clicking "MPMF" on the dashboard, you can click "Edit Field" next to the name of the form you want to add fields to. You will be taken to a page with the form's preview and buttons representing fields you can add.

= How can I delete a form or a field? =

Go to your dashboard and click "MPMF", you will see a list of your currently available forms. Click delete next to the name of the form you want to delete.

= Where do I see my forms before I can publish them =

Go to your wordpress admin page, under 'MPMF' click 'Edit Fields'. On the page that will open you will see a preview of the form you selected.

= How do I use my custom forms = 

In the form list on the main page of the plugin, copy the shortcode on the right of the plugin you want to insert to a page. Paste the shortcode in any page/post you want it displayed.

== Screenshots ==

1. screenshot1.png - Shows the main menu and the main page of the plugin where you can create forms.
2. screenshot2.png - Form Preview and form design screen. This is where you build your form by adding your fields
3. screenshot3.png - Adding or customizing a form field with multiple options
4. screenshot3.png - Default form on the frontend
5. screenshot5.png - Custom form displayed in web page
6. screenshot6.png - Plugin Settings screen
7. screenshot7.png - Received data. Shows the data that was sent from the custome forms. You can now see the data right in your admin


== Changelog ==

= 1.0.2 =
* Fixed jQuery errors on admin

= 1.0.1 =
* Fixed installer bug

= 1.0.0 =

* Complete redisgn and rebuild.
* Improved design
* Improved controls
* Custom labels and button text for the default form
* Options to choose which fields to show on the default form - good for translations
* Custom error messages - good for translation
* Google recaptcha field
* Predefined personal data fields
* Predefined list of countries and states for United States, United Kingdom, Australia, India, and South Africa. States for more countries coming soon.
* Bug fixes from previous code
* Received messages/data stored in database so you can see them right in your admin instead of logging in to email.
* Introduced advanced field
	- File upload or input
    - Google ReCaptcha - for security and spam prevention
    - Paragraphs
    - Pre defined user fiels like, first name, last name, address, city, state, country, zip code. These can be inserted into any form with one click


= 0.6.1 =

* Fixed the send email bug - now emails are sent correctly

= 0.6 =

* 'MPMF' Now shown as an object page - independent menu item
* Added submenus for the plugin's admin and help - (Create New Form, Manage Form, Help)
* Create Custom forms as you like 
	- Modify or change form
    - Add fields to a form
    - Modify form fields
* Tweaked interface
* minor bug fixes

= 0.5 =
* No current changes to the plugin.

== Upgrade Notice ==

= No upgrade required =

== Arbitrary section ==

The form has the following cababilities:

1. Will automatically Validate the data entered via the online form before submitting the form
2. Change contact details on admin page without changing the plugin's files
3. All data currently sent to the email address you provided on the admin page
4. Any number of fields created will be validated before sending data - the user will be asked to return to the form to fill in the missing information

== A brief Markdown Example ==

Visit our [YouTube Channel](https://www.youtube.com/user/mahlamusa/ "YouTube Channel") for up to date video tutorials and plugin documentation. Here's a link to [3px Web Solutions](http://3px.co.za/ ""),
and to [Lindeni Mahlalela's website](http://mahlamusa.co.za/ "Plugin Author"). 

