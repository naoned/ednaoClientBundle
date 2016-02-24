
This bundle must be linked to ednao (naoned help system) and cannot be used without it

This bundle provide the edano client in symony projects

# Install and config

To install through composer, first declare the repository :

```
    "repositories": [
        …
        {
            "type": "vcs",
            "url":  "git@github.com:naoned/ednaoClientBundle.git"
        },
        {
            "type": "vcs",
            "url":  "git@github.com:naoned/ednaoClient.git"
        }
```

```
composer require naoned/ednaoClient dev-master@dev
composer require naoned/ednaoClientBundle dev-master@dev
```

Enable bundle in your app/AppKernel.php

```
$bundles = array(
    …
    new Naoned\EdnaoClientBundle\NaonedEdnaoClientBundle(),
);
```

Add needed config.yml

```
naoned_ednao_client:
    url_fallback: http://aide.mnesys.fr
    product: xnao_variant
    socle: xnao
    version: 0
```

The parameter ``naoned_ednao_client.url`` can be defined in a parameters.json or parameters.yml according to your bundle. Like this :
```
    "naoned_ednao_client": {
        "url": "http://release.insitu.help.mnesys.fr"
    }
```

``url_fallback `` will be used if ``naoned_ednao_client.url`` is not defined or if it is not a valid url.

Optionnaly, the version (and other stuff) can be dynamically redefined in your bundle, in ``DependencyInjection/XxxxxExtension.php`` :

```
<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
…

class XxxxxExtension extends Extension implements PrependExtensionInterface
{
    …

    public function prepend(ContainerBuilder $container)
    {
        $version = '1 // Any logic to find version Id
        $container->setParameter('naoned_ednao_client.version', $version);
    }
}
```

## Use it in your view

Add js somewhere in your front end :
```
<script type="text/javascript" src="{{ asset('/bundles/ednaoclient/js/ednaoManager.js') }}"></script>
```

Add iframe somewhere in your front end :
```
{{ ednaoIframe()|raw }}
```

Add JS logic to call the help, like this :
```
<a href="javascript:ednaoManager.show();">?</a>
```

Available methods are
```
    <script type="text/javascript">
        ednaoManager.goToContext('classement');
        ednaoManager.show();
        ednaoManager.hide();
    </script>
```

To get deeper, see https://github.com/naoned/ednaoClient
