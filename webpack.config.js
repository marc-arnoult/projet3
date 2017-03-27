var webpack = require('webpack');

module.exports = {
    entry: {
        app: [
            './public/js/app.js',
            './public/js/home.js',
            './public/js/comment.js',
            './public/js/comment_edit.js'
        ]
    },
    output: {
        path: __dirname + '/public/dist',
        filename: 'app.min.js'
    },
    module: {
        loaders: [
            {
                test: /\.css$/,
                loaders: ['style', 'css']
            }
        ]
    },
    plugins: [
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false
            }
        })
    ]
};
