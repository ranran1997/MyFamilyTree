import { task, src, dest } from "gulp";
import htmlmin from "gulp-htmlmin";

task("testHtmlmin", function () {
    var options = {
        removeComments: false,  // 删除 HTML 注释标签
        collapseWhitespace: true,   // 压缩 HTML
        collapseBooleanAttributes: true,    // 省略 Bool 属性的值
        removeEmptyAttributes: true,    // 删除值为空字符串的属性
        removeScriptTypeAttributes: true,   // 删除 type="text/javascript"
        removeStyleLinkTypeAttributes: true,    // 删除 type="text/css"
        minifyJS: false, // 压缩页面 JS
        minifyCSS: true // 压缩页面 CSS
    };
    var sources = [
        {
            "src": "*.hst",
            "dest": "dist"
        }, {
            "src": "*.html",
            "dest": "dist"
        }, {
            "src": "hst/*.hst",
            "dest": "dist/hst"
        }, {
            "src": "quelaag_furysword/*.hst",
            "dest": "dist/quelaag_furysword"
        },
        {
            "src": "quelaag_furysword/template/*.hst",
            "dest": "dist/quelaag_furysword/template"
        }
    ];

    sources.forEach(function (v) {
        src(v['src'])
            .pipe(htmlmin(options))
            .pipe(dest(v['dest']));
    })
});
