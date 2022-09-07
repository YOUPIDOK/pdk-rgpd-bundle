# PdkRgpdBundle
> Sonata RGPD manager
> * Privacy policy management
> * GCU management
> * GCT management

## Dependencies
* Symfony ``6.1``
* Sonata ``4.1``

## Installation
###  Step 1
```json
// composer.json
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/YOUPIDOK/pdk-rgpd-bundle.git"
        }
    ]
```
### Step 2
``composer require pdk/rgpd-bundle``

## Configuration
### Sonata admin
```yaml
# config/packages/sonata/sonata_admin.yaml
sonata_admin:
    dashboard:
        groups:
            rgpd:
                label: RGPD
                icon: '<i class="fa fa-file-text-o"></i>'
                items:
                    - pdk.rgpd.admin.privacy_policy
                    - pdk.rgpd.admin.gcu
```


        