/**
 * Card Item Block
 *
 * @package Kurv_Knowledgebase_2026
 * @since 1.0.0
 */

import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from '../block.json';

registerBlockType( metadata.name, {
	...metadata,
	edit: ( { attributes, setAttributes } ) => {
		const { icon, title, titleLevel } = attributes;
		const blockProps = useBlockProps( {
			className: 'card-item',
		} );

		const TitleTag = `h${ titleLevel }`;

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Card Settings', 'kurv-knowledgebase-2026' ) }>
						<TextControl
							label={ __( 'Icon', 'kurv-knowledgebase-2026' ) }
							value={ icon }
							onChange={ ( value ) => setAttributes( { icon: value } ) }
							help={ __( 'Enter an emoji or icon character', 'kurv-knowledgebase-2026' ) }
						/>
						<SelectControl
							label={ __( 'Title Level', 'kurv-knowledgebase-2026' ) }
							value={ titleLevel }
							options={ [
								{ label: 'H1', value: 1 },
								{ label: 'H2', value: 2 },
								{ label: 'H3', value: 3 },
								{ label: 'H4', value: 4 },
								{ label: 'H5', value: 5 },
								{ label: 'H6', value: 6 },
							] }
							onChange={ ( value ) => setAttributes( { titleLevel: parseInt( value ) } ) }
						/>
					</PanelBody>
				</InspectorControls>

				<div { ...blockProps }>
					<div className="card-item-icon">
						<span style={ { fontSize: '4rem', display: 'block' } }>{ icon }</span>
					</div>
					
					<TitleTag className="card-item-title">
						<RichText
							tagName="span"
							value={ title }
							onChange={ ( value ) => setAttributes( { title: value } ) }
							placeholder={ __( 'Card Title', 'kurv-knowledgebase-2026' ) }
						/>
					</TitleTag>
					
					<div className="card-item-content">
						<InnerBlocks
							allowedBlocks={ [ 'core/paragraph', 'core/heading', 'core/list' ] }
							template={ [
								[ 'core/paragraph', { placeholder: __( 'Enter card description...', 'kurv-knowledgebase-2026' ) } ],
							] }
						/>
					</div>
				</div>
			</>
		);
	},
	save: ( { attributes } ) => {
		const { icon, title, titleLevel } = attributes;
		const blockProps = useBlockProps.save( {
			className: 'card-item',
		} );

		const TitleTag = `h${ titleLevel }`;

		return (
			<div { ...blockProps }>
				{ icon && (
					<div className="card-item-icon">
						{ icon }
					</div>
				) }
				{ title && (
					<TitleTag className="card-item-title">
						{ title }
					</TitleTag>
				) }
				<div className="card-item-content">
					<InnerBlocks.Content />
				</div>
			</div>
		);
	},
} );
