# PdkRgpdBundle
> Sonata RGPD manager
> * Privacy policy management
> * GCU management
> * GCS management

## Dependencies
* Symfony ``6.1``
* Sonata ``4.1``
* PrestaSitemap ``3.3``

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
### Routes
```yaml
# config/routes/pdk_rgpd.yaml
#
# Create this file for register routes

pdk_rgpd:
  resource: "@PdkRgpdBundle/config/routes.yaml"
```
### Sonata admin
```yaml
# config/packages/sonata_admin.yaml
#
# If you add an admin part, don't forget to activate this

sonata_admin:
    dashboard:
        groups:
            rgpd:
                label: RGPD
                icon: '<i class="fa fa-file-text-o"></i>'
                items:
                    - pdk.rgpd.admin.privacy_policy
                    - pdk.rgpd.admin.gcu
                    - pdk.rgpd.admin.gcs
```
### Bundle
```yaml
# config/pdk_rgpd.yaml
#
# You can override template or juste set the extends template
# By default each feature are disabled

pdk_rgpd:
  privacy_policy:
    activate: false
    template: @PdkRgpd/pages/privacy_policy.html.twig
  gcu:
    activate: false
    template: @PdkRgpd/pages/gcu.html.twig
  gcs:
    activate: false
    template: @PdkRgpd/pages/gcs.html.twig
  base_templae: 'base.html.twig'
```