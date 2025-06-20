<?php

namespace App\Http\Policies;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policies\Basic;

class ContentSecurityPolicy extends Basic
{
    public function configure()
    {
        // parent::configure();

        if(request()->is('admin/*')){
            if(!request()->is('admin/campaign/preview/*')){
                $this->addNonceForDirective(Directive::STYLE);
            }
        }

        $this
        //start of basic policy
        ->addDirective(Directive::BASE, Keyword::SELF)
        ->addDirective(Directive::CONNECT, Keyword::SELF)
        ->addDirective(Directive::DEFAULT, Keyword::SELF)
        ->addDirective(Directive::FORM_ACTION, Keyword::SELF)
        ->addDirective(Directive::IMG, Keyword::SELF)
        ->addDirective(Directive::MEDIA, Keyword::SELF)
        ->addDirective(Directive::OBJECT, Keyword::NONE)
        ->addDirective(Directive::SCRIPT, Keyword::SELF)
        ->addDirective(Directive::STYLE, Keyword::UNSAFE_INLINE)
        ->addDirective(Directive::STYLE, Keyword::SELF)
        ->addDirective(Directive::FRAME, Keyword::SELF)
        ->addDirective(Directive::FONT, Keyword::SELF)
        ->addNonceForDirective(Directive::SCRIPT);

        //end of basic policy

        //start of custom policy
        $this
        //start of
        ->addDirective(Directive::IMG, 'data:')
        ->addDirective(Directive::IMG, 'https://snnrajcorp.com')
        ->addDirective(Directive::FONT, 'data:') //remove as this and above belongs for development template of welcome page

        //start of artibot
        ->addDirective(Directive::SCRIPT, 'app.artibot.ai')
        ->addDirective(Directive::FRAME, 'app.artibot.ai')
        ->addDirective(Directive::SCRIPT, 'prod.artibotcdn.com')
        ->addDirective(Directive::CONNECT, 'api.artibot.ai')
        ->addDirective(Directive::CONNECT, 'api-cdn.prod-aws.artibot.ai')
        ->addDirective(Directive::IMG, 's3.amazonaws.com')

        //start of common
        ->addDirective(Directive::CONNECT, 'https://ipapi.co/json')
        ->addDirective(Directive::CONNECT, 'pgtrack.plumb5.com')
        ->addDirective(Directive::CONNECT, 'pgchat.plumb5.com')
        ->addDirective(Directive::FORM_ACTION, 'pgtrack.plumb5.com')
        ->addDirective(Directive::CONNECT, 'www.googletagmanager.com')
        ->addDirective(Directive::CONNECT, 'www.google-analytics.com')
        ->addDirective(Directive::CONNECT, 'pgtrack.plumb5.com')
        ->addDirective(Directive::STYLE, 'cdn.jsdelivr.net')
        ->addDirective(Directive::IMG, 'cdn.jsdelivr.net')
        ->addDirective(Directive::IMG, 'www.google.com')
        ->addDirective(Directive::IMG, 'www.google.co.in')
        ->addDirective(Directive::IMG, 'p5email-email-template-images.s3.amazonaws.com')
        ->addDirective(Directive::IMG, 'googleads.g.doubleclick.net')
        ->addDirective(Directive::SCRIPT, 'www.youtube.com/iframe_api')
        ->addDirective(Directive::SCRIPT, 'www.youtube.com')
        ->addDirective(Directive::SCRIPT, 'cdn.jsdelivr.net')
        ->addDirective(Directive::SCRIPT, 'www.googletagmanager.com')
        ->addDirective(Directive::SCRIPT, 'pgtrack.plumb5.com')
        ->addDirective(Directive::SCRIPT, 'unpkg.com')
        ->addDirective(Directive::SCRIPT, 'kit.fontawesome.com')
        ->addDirective(Directive::SCRIPT, 'src.plumb5.com')
        ->addDirective(Directive::SCRIPT, 'pgchat.plumb5.com')
        ->addDirective(Directive::IMG, 'src.plumb5.com')
        ->addDirective(Directive::STYLE, 'src.plumb5.com')
        ->addDirective(Directive::FONT, 'src.plumb5.com')
        ->addDirective(Directive::CONNECT, 'ka-f.fontawesome.com')
        ->addDirective(Directive::FONT, 'ka-f.fontawesome.com')
        ->addDirective(Directive::STYLE, 'unpkg.com')
        ->addDirective(Directive::IMG, 'i.ytimg.com')
        ->addDirective(Directive::IMG, 'i3.ytimg.com')
        ->addDirective(Directive::FONT, 'at.alicdn.com')
        ->addDirective(Directive::FONT, 'fonts.gstatic.com')
        ->addDirective(Directive::STYLE, 'fonts.googleapis.com')
        ->addDirective(Directive::FRAME, 'www.google.com')
        ->addDirective(Directive::FRAME, 'www.youtube.com');
    }

}

?>
