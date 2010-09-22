# Goodies plugin for CakePHP #

Various CakePHP Goodies.

* AutoJavascript Helper - Automatically include Javascript based on the current Controller / Action.
* Gravatar Helper - Use global avatars just by supplying your users email address.

Author: [Graham Weldon](http://grahamweldon.com)

Repository: [Goodies @ GitHub](http://github.com/predominant/goodies)

# Installation #

Place the `goodies` directory from this package into your `/app/plugins` directory.

Thats all that is required. See usage instructions below.

# Contents #

## AutoJavascript Helper ##

The AutoJavascript helper automatically includes javascript files based on the current Controller and Action that the user is currently visiting. This enables you to have a neat and predictable separation for javascript files for your application.

There is also support for controller-wide scripts.

### Usage ###

Include the AutoJavascript helper on your AppController class. If you do not have an AppController, create one in `/app/app_controller.php`.

	class AppController extends Controller {
		public $helpers = array('Goodies.AutoJavascript');
		// ...
	}

Thats all you need to to for the default configuration.

The auto javascript helper will look for javascript files to include in the following location:

	/app/webroot/js/autoload/<controller>/<action>.js

For example, if we have a `PostsController` and we're browsing to the `view` action on that controller, the auto javascript helper will look for the following file:

	/app/webroot/js/autoload/posts/view.js

If that file exists, it will be included automatically for you.

#### Controller-wide javascript ####

Often its handy to have a javascript file included for _every_ action on a particular controller. The location for these controller wide files is:

	/app/webroot/js/autoload/<controller>.js

For the `PostsController` in our previous example, if you wanted some javascript loaded for every action on that controller, you would place your javascript into the following file:

	/app/webroot/js/autoload/posts.js

#### Theme support ####

The AutoJavascript helper has full support for themes. If you are using the [ThemeView](http://book.cakephp.org/view/1093/Themes) and wish to include javascript in your theme webroot, the naming mechanism remains the same as the above examples, and the theme path is adjusted.

The location for themed automatic javascript includes is:

	/app/views/themed/<theme>/webroot/js/autoload/<controller>/<action>.js

If you are using the `fancy` theme, your paths for previous examples would be:

	/app/views/themed/fancy/webroot/js/autoload/posts/view.js

	/app/views/themed/fancy/webroot/js/autoload/posts.js

## Gravatar Helper ##

The Gravatar helper provides an easy way to integrate [Gravatars](http://gravatar.com) into your CakePHP application.

### Usage ###

Include the Gravatar helper on your controller (This can be your AppController, if you want to use gravatars throughout your application).

	class MyController extends AppController {
		public $helpers = array('Goodies.Gravatar');
		// ...
	}

Or, if you are already using some helpers, add it to your helper array:

	class MyController extends AppController {
		public $helpers = array('Html', 'Session', 'Form', 'Gravatar');
		// ...
	}

Now you can use the helper in any of your views:

	echo $this->Gravatar->image('someone@cakeisawesome.com');

### Customising the output ###

There are a number of options provided by the Gravatar service. They are all available through the helper.

#### Altering the default image ####

	echo $gravatar->image(
		'someone@cakeisawesome.com',
		array(
			'default' => 'identicon'
		)
	);

#### Altering the default gravatar with a custom image ###

	echo $gravatar->image(
		'someone@cakeisawesome.com',
		array(
			'default' => 'http://mysite.com/defaultavatar.png'
		)
	);

#### Changing the gravatar size ####

	echo $gravatar->image(
		'someone@cakeisawesome.com',
		array(
			'size' => 120
		)
	);

#### Limiting the gravatar rating ####

	echo $gravatar->image(
		'someone@cakeisawesome.com',
		array(
			'rating' => 'x'
		)
	);

#### Including the filename extension on the generated URL ####

	echo $gravatar->image(
		'someone@cakeisawesome.com',
		array(
			'ext' => true
		)
	);

#### Combining options ####

Any combination of the above options is possible. For example:

	echo $gravatar->image(
		'someone@cakeisawesome.com',
		array(
			'rating' => 'g',
			'default' => 'http://mysite.com/defaultavatar.png',
			'size' => 80
		)
	);

# Copyright #

Copyright (c) 2009-2010 Graham Weldon (http://grahamweldon.com)

# License #

	Licensed under the MIT License: http://www.opensource.org/licenses/mit-license.php

	The MIT License

	Copyright (c) 2009-2010 Graham Weldon (http://grahamweldon.com)

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
