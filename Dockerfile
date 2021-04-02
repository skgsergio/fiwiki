ARG mediawiki_image_tag

FROM mediawiki:$mediawiki_image_tag

## Wikimedia skins and extensions

RUN git clone --depth 1 --branch REL$(echo $MEDIAWIKI_MAJOR_VERSION | tr '.' '_') https://github.com/wikimedia/mediawiki-skins-MinervaNeue.git skins/MinervaNeue && rm -rf skins/MinervaNeue/.git

RUN git clone --depth 1 --branch REL$(echo $MEDIAWIKI_MAJOR_VERSION | tr '.' '_') https://github.com/wikimedia/mediawiki-extensions-MobileFrontend.git extensions/MobileFrontend && rm -rf extensions/MobileFrontend/.git

RUN git clone --depth 1 --branch REL$(echo $MEDIAWIKI_MAJOR_VERSION | tr '.' '_') https://github.com/wikimedia/mediawiki-extensions-UserMerge.git extensions/UserMerge && rm -rf extensions/UserMerge/.git

## 3rd party extensions

RUN git clone --depth 1 --branch v0.8.2 https://github.com/jmnote/SimpleMathJax.git extensions/SimpleMathJax && rm -rf extensions/SimpleMathJax/.git

## Fix permissions

RUN chown -R www-data:www-data skins extensions
