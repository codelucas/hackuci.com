The code powering www.hackuci.com
---------------------------------
![HackUCI Logo](images/logo-with-bg.jpg)

UC Irvine's first ever hackathon. It is to be held on 
Memorial Day Weekend - 23rd-25th.

Incase someone else operates this website in the future,
i've included instructions below along with a *hopefully* well
commented and structured front-end webapp.

###Overall organization:
- All waivers, info packets, and general documents are placed inside
the `/docs` folder.
- CSS, Javascript, and Images are placed within their respective 
`/css`, /js`, and `/images` folders.
- Copy-paste mailchimp registration code *refer to how to toggle Mailchimp
registration below* can be inserted or removed from our main website by
pasting the `/mailchimp.html` contents into the `/index.html` code where
specified.
- Nginx HTTP server configuration setup is within the `/server/nginx.conf` 
directory.
- CSS is divided into two main files. `/css/style.css` and `/css/colors.css`.
The `style.css` file contains most of the content while colors mainly focuses on
color themes for blocks of HTML.

###How to deploy via a server:
- I use the [nginx](http://nginx.org) server to host this website because
nginx is designed to be a great http server for static files (this entire website
is static). 
- If you opt to use nginx, read their setup and installation guide 
[here](http://wiki.nginx.org/Configuration) and paste my configs in 
`/server/nginx.conf` in. If you opt to use something else like 
[apache server](http://httpd.apache.org/) you're going to have to create 
your own configs.


###How to toggle Mailchimp registration, Eventbrite, etc.. 
TODO


By: [Lucas Ou](http://lucasou.com), please don't hesitate to
[contact](http://lucasou.com) me if you have questions on this site.
