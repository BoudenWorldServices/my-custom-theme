/**
 * Goliath Blocks — Webpack config.
 *
 * Extends @wordpress/scripts with auto-detected block entry points.
 * The default config's entry is a function; we replace it with our own
 * static map so each blocks/{name}/index.js gets its own compiled output.
 */

const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );
const fs = require( 'fs' );

const blocksDir = path.resolve( __dirname, 'blocks' );

const entries = {};
if ( fs.existsSync( blocksDir ) ) {
    fs.readdirSync( blocksDir ).forEach( ( blockName ) => {
        const src = path.join( blocksDir, blockName, 'index.js' );
        if ( fs.existsSync( src ) ) {
            entries[ blockName ] = src;
        }
    } );
}

module.exports = Object.assign( {}, defaultConfig, {
    entry: entries,
    output: Object.assign( {}, defaultConfig.output, {
        path: path.resolve( __dirname, 'blocks-build' ),
        filename: '[name]/index.js',
    } ),
} );
