var webpack = require('webpack');
var ExtractTextPlugin = require("extract-text-webpack-plugin");
var OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');


module.exports = {
    entry: {
        app: [
            './public/js/app.js',
            './public/js/home.js',
            './public/js/comment.js',
            './public/js/comment_edit.js',
            './public/css/app.css'
        ]
    },
    output: {
        path: __dirname + '/public/dist',
        filename: 'app.min.js'
    },
    module: {
        loaders: [
            { test: /\.css$/, loader: ExtractTextPlugin.extract({ fallback: 'style-loader', use: 'css-loader' })}
        ]
    },
    plugins: [
        new ExtractTextPlugin('app.min.css'),
        new OptimizeCssAssetsPlugin({
            assetNameRegExp: /\.css$/g,
            cssProcessor: require('cssnano'),
            cssProcessorOptions: { discardComments: {removeAll: true } },
            canPrint: true
        }),
        new webpack.optimize.UglifyJsPlugin({compress: {warnings: false}})
    ]
};
