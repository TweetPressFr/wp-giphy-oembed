import {__} from "@wordpress/i18n";

const createEl = window.wp.element.createElement,
 icon = createEl('svg', {key: 'giphy-svg', width: 20, height: 20},
  createEl('path', {
    key: 'giphy-path',
    d: "M17 4H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-7 8H3V6h7v6zm4-1.5L12.5 12l1.5 1.5V15l-3-3 3-3v1.5zm1 4.5v-1.5l1.5-1.5-1.5-1.5V9l3 3-3 3zm-6-4V8.5L7.2 10 6 9.2 4 11h5zM4.6 8.6c.6 0 1-.4 1-1s-.4-1-1-1-1 .4-1 1 .4 1 1 1z"
  })
 );

/**
 * La lala la la
 * @param props
 * @returns {*}
 * @constructor
 */
function Form(props) {

  return createEl(
   'div', {
     className: 'components-placeholder',
     key: 'giphy-oembed-block'
   },
   createEl(
    'div', {
      key: 'giphy-placeholder',
      className: 'components-placeholder__label'
    },
    [
      icon,
      createEl(
       'label', {
         style: {
           'marginLeft': '.5em'
         },
         key: 'giphy-label',
         htmlFor: 'url-input-' + props.id
       }, __('Giphy URL', 'goe')
      )
    ]
   ),
   createEl(
    'div', {
      className: 'components-placeholder__fieldset',
      key: 'giphy-fieldset'
    }, createEl(
     'form', {
       onSubmit: function (e) {
         e.preventDefault();
         let _url = encodeURIComponent(props.attributes.url);

         window.fetch(window.wpApiSettings.root + "oembed/1.0/proxy" +
          '?url=' + _url +
          '&_wpnonce=' + window.wpApiSettings.nonce, {credentials: 'include'})
          .then(
           function (response) {
             if (response.status !== 200) {
               console.log(response);
             } else {
               response.json().then(function (re) {
                 props.setAttributes({
                   src: re.url,
                   width: re.width,
                   height: re.height
                 });
               });
             }
           }
          ).catch(function (response) {
            console.log(response);
         });
       },
       key: 'giphy-form'
     },
     [
       createEl(
        'input', {
          key: 'giphy-url-input',
          type: 'url',
          required: 'required',
          id: 'url-input-' + props.id,
          placeholder: __('Enter URL to embed here...', 'goe'),
          className: 'components-placeholder__input',
          onChange: function (event) {
            event.preventDefault();
            props.setAttributes({
              url: event.target.value
            });
          }
        }
       ),
       createEl(
        'button', {
          key: 'giphy-button',
          type: 'submit',
          className: 'components-button button button-large',
        },
        __('Embed', 'goe')
       )
     ]
    )
   )
  );
}

/**
 * La lala la la
 * @param props
 * @returns {*}
 * @constructor
 */
function Video(props) {
  const src = props.attributes.src,
   video = src.replace('.gif', '.mp4', src);

  return createEl(
   'div',
   {
     className: 'wp-block-embed is-provider-giphy',
     key: 'giphy-embed-container',
   },
   createEl(
    'video', {
      key: 'giphy-embed-video',
      poster: src,
      width: props.attributes.width,
      height: props.attributes.height,
      autoPlay: true,
      loop: true
    },
    createEl(
     'source',
     {
       type: "video/mp4",
       src: video
     }
    )
   ),
   createEl(
    'p',
    {
      key: 'giphy-mention-container',
    },
    createEl(
     'a',
     {
       key: 'giphy-mention-link',
       href:props.attributes.url
     },
     __( 'Via Giphy','goe')
    )
   )
  );
}

window.wp.blocks.registerBlockType('wp-giphy-oembed/main', {
  title: __('Giphy', 'goe'),
  icon: icon,
  anchor: true,
  category: 'embed',
  type : 'wp-embed',
  formattingControls:[],
  keywords: [__('gi', 'goe'), __('gif', 'goe'), __('gifs', 'goe')],
  attributes: {
    alignment: {
      type: 'string',
    },
    url: {
      type: 'string'
    },
    src: {
      type: 'string'
    },
    width: {
      type: 'integer'
    },
    height: {
      type: 'integer'
    }
  },
  edit: function (props) {
    if (!props.attributes.src) {
      return new Form(props);
    }
    return new Video(props);
  },
  save: function (props) {

    if (!props || !props.attributes.url) {
      return;
    }
    return new Video(props);
  }
});
