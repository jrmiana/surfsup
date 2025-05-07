import { __ } from '@wordpress/i18n';
import './editor.scss';

import {
    useBlockProps,
    MediaUpload,
    MediaUploadCheck,
    RichText,
    InspectorControls,
    URLInput
  } from '@wordpress/block-editor';
  import {
    Button,
    PanelBody,
    TextControl
  } from '@wordpress/components';
  
  export default function Edit({ attributes, setAttributes }) {
    const {
      imageUrl,
      heading,
      text,
      buttonText,
      buttonUrl
    } = attributes;
  
    return (
      <>
        {/* Sidebar controls */}
        <InspectorControls>
          <PanelBody title={__('Image Settings', 'hero-block')} initialOpen={true}>
            <MediaUploadCheck>
              <MediaUpload
                onSelect={(media) => setAttributes({ imageUrl: media.url })}
                allowedTypes={['image']}
                render={({ open }) => (
                  <Button onClick={open} isSecondary>
                    {imageUrl ? __('Replace Image', 'hero-block') : __('Upload Image', 'hero-block')}
                  </Button>
                )}
              />
            </MediaUploadCheck>
          </PanelBody>
  
          <PanelBody title={__('CTA Button Settings', 'hero-block')} initialOpen={false}>
            <TextControl
              label={__('Button Text', 'hero-block')}
              value={buttonText}
              onChange={(val) => setAttributes({ buttonText: val })}
              placeholder={__('Learn More', 'hero-block')}
            />
            <URLInput
              label={__('Button URL', 'hero-block')}
              value={buttonUrl}
              onChange={(val) => setAttributes({ buttonUrl: val })}
              placeholder="https://example.com"
            />
          </PanelBody>
        </InspectorControls>
  
        {/* Block preview in content area */}
        <div {...useBlockProps({ className: 'hero-block' })}>
          {imageUrl && <img src={imageUrl} alt="" className="hero-image" />}
  
          <div class="text-area">
          <RichText
            tagName="h2"
            value={heading}
            onChange={(val) => setAttributes({ heading: val })}
            placeholder={__('Add heading…', 'hero-block')}
            className="hero-heading"
          />
  
          {buttonText && buttonUrl && (
            <a href={buttonUrl} className="hero-button" target="_blank" rel="noopener noreferrer">
              {buttonText}
            </a>
          )}
          </div>
        </div>
      </>
    );
}