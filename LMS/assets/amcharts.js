!function() {
    var a;
    window.AmCharts ? a = window.AmCharts : (a = {}, window.AmCharts = a, a.themes = {}, 
    a.maps = {}, a.inheriting = {}, a.charts = [], a.onReadyArray = [], a.useUTC = !1, 
    a.updateRate = 60, a.uid = 0, a.lang = {}, a.translations = {}, a.mapTranslations = {}, 
    a.windows = {}, a.initHandlers = []);
    a.Class = function(b) {
        var c = function() {
            arguments[0] !== a.inheriting && (this.events = {}, this.construct.apply(this, arguments));
        };
        b.inherits ? (c.prototype = new b.inherits(a.inheriting), c.base = b.inherits.prototype, 
        delete b.inherits) : (c.prototype.createEvents = function() {
            for (var a = 0; a < arguments.length; a++) this.events[arguments[a]] = [];
        }, c.prototype.listenTo = function(a, b, c) {
            this.removeListener(a, b, c);
            a.events[b].push({
                handler: c,
                scope: this
            });
        }, c.prototype.addListener = function(a, b, c) {
            this.removeListener(this, a, b);
            a && this.events[a] && this.events[a].push({
                handler: b,
                scope: c
            });
        }, c.prototype.removeListener = function(a, b, c) {
            if (a && a.events && (a = a.events[b])) for (b = a.length - 1; 0 <= b; b--) a[b].handler === c && a.splice(b, 1);
        }, c.prototype.fire = function(a) {
            for (var b = this.events[a.type], c = 0; c < b.length; c++) {
                var d = b[c];
                d.handler.call(d.scope, a);
            }
        });
        for (var d in b) c.prototype[d] = b[d];
        return c;
    };
    a.addChart = function(b) {
        window.requestAnimationFrame ? a.animationRequested || (a.animationRequested = !0, 
        window.requestAnimationFrame(a.update)) : a.updateInt || (a.updateInt = setInterval(function() {
            a.update();
        }, Math.round(1e3 / a.updateRate)));
        a.charts.push(b);
    };
    a.removeChart = function(b) {
        for (var c = a.charts, d = c.length - 1; 0 <= d; d--) c[d] == b && c.splice(d, 1);
        0 === c.length && a.updateInt && (clearInterval(a.updateInt), a.updateInt = 0/0);
    };
    a.isModern = !0;
    a.getIEVersion = function() {
        var a = 0, b, c;
        "Microsoft Internet Explorer" == navigator.appName && (b = navigator.userAgent, 
        c = /MSIE ([0-9]{1,}[.0-9]{0,})/, null !== c.exec(b) && (a = parseFloat(RegExp.$1)));
        return a;
    };
    a.applyLang = function(b, c) {
        var d = a.translations;
        c.dayNames = a.extend({}, a.dayNames);
        c.shortDayNames = a.extend({}, a.shortDayNames);
        c.monthNames = a.extend({}, a.monthNames);
        c.shortMonthNames = a.extend({}, a.shortMonthNames);
        c.amString = "am";
        c.pmString = "pm";
        d && (d = d[b]) && (a.lang = d, d.monthNames && (c.dayNames = a.extend({}, d.dayNames), 
        c.shortDayNames = a.extend({}, d.shortDayNames), c.monthNames = a.extend({}, d.monthNames), 
        c.shortMonthNames = a.extend({}, d.shortMonthNames)), d.am && (c.amString = d.am), 
        d.pm && (c.pmString = d.pm));
    };
    a.IEversion = a.getIEVersion();
    9 > a.IEversion && 0 < a.IEversion && (a.isModern = !1, a.isIE = !0);
    a.dx = 0;
    a.dy = 0;
    if (document.addEventListener || window.opera) a.isNN = !0, a.isIE = !1, a.dx = .5, 
    a.dy = .5;
    document.attachEvent && (a.isNN = !1, a.isIE = !0, a.isModern || (a.dx = 0, a.dy = 0));
    window.chrome && (a.chrome = !0);
    a.handleMouseUp = function(b) {
        for (var c = a.charts, d = 0; d < c.length; d++) {
            var e = c[d];
            e && e.handleReleaseOutside && e.handleReleaseOutside(b);
        }
    };
    a.handleMouseMove = function(b) {
        for (var c = a.charts, d = 0; d < c.length; d++) {
            var e = c[d];
            e && e.handleMouseMove && e.handleMouseMove(b);
        }
    };
    a.handleWheel = function(b) {
        for (var c = a.charts, d = 0; d < c.length; d++) {
            var e = c[d];
            if (e && e.mouseIsOver) {
                e.mouseWheelScrollEnabled || e.mouseWheelZoomEnabled ? e.handleWheel && e.handleWheel(b) : b.stopPropagation && b.stopPropagation();
                break;
            }
        }
    };
    a.resetMouseOver = function() {
        for (var b = a.charts, c = 0; c < b.length; c++) {
            var d = b[c];
            d && (d.mouseIsOver = !1);
        }
    };
    a.ready = function(b) {
        a.onReadyArray.push(b);
    };
    a.handleLoad = function() {
        a.isReady = !0;
        for (var b = a.onReadyArray, c = 0; c < b.length; c++) {
            var d = b[c];
            isNaN(a.processDelay) ? d() : setTimeout(d, a.processDelay * c);
        }
    };
    a.addInitHandler = function(b, c) {
        a.initHandlers.push({
            method: b,
            types: c
        });
    };
    a.callInitHandler = function(b) {
        var c = a.initHandlers;
        if (a.initHandlers) for (var d = 0; d < c.length; d++) {
            var e = c[d];
            e.types ? a.isInArray(e.types, b.type) && e.method(b) : e.method(b);
        }
    };
    a.getUniqueId = function() {
        a.uid++;
        return "AmChartsEl-" + a.uid;
    };
    a.isNN && (document.addEventListener("mousemove", a.handleMouseMove), document.addEventListener("mouseup", a.handleMouseUp, !0), 
    window.addEventListener("load", a.handleLoad, !0), window.addEventListener("DOMMouseScroll", a.handleWheel, !0), 
    document.addEventListener("mousewheel", a.handleWheel, !0));
    a.isIE && (document.attachEvent("onmousemove", a.handleMouseMove), document.attachEvent("onmouseup", a.handleMouseUp), 
    window.attachEvent("onload", a.handleLoad), document.attachEvent("onmousewheel", a.handleWheel));
    a.clear = function() {
        var b = a.charts;
        if (b) for (var c = b.length - 1; 0 <= c; c--) b[c].clear();
        a.updateInt && clearInterval(a.updateInt);
        a.charts = [];
        a.isNN && (document.removeEventListener("mousemove", a.handleMouseMove, !0), document.removeEventListener("mouseup", a.handleMouseUp, !0), 
        window.removeEventListener("load", a.handleLoad, !0), window.removeEventListener("DOMMouseScroll", a.handleWheel, !0), 
        document.removeEventListener("mousewheel", a.handleWheel, !0));
        a.isIE && (document.detachEvent("onmousemove", a.handleMouseMove), document.detachEvent("onmouseup", a.handleMouseUp), 
        window.detachEvent("onload", a.handleLoad));
    };
    a.makeChart = function(b, c, d) {
        var e = c.type, f = c.theme;
        a.isString(f) && (f = a.themes[f], c.theme = f);
        var g;
        switch (e) {
          case "serial":
            g = new a.AmSerialChart(f);
            break;

          case "xy":
            g = new a.AmXYChart(f);
            break;

          case "pie":
            g = new a.AmPieChart(f);
            break;

          case "radar":
            g = new a.AmRadarChart(f);
            break;

          case "gauge":
            g = new a.AmAngularGauge(f);
            break;

          case "funnel":
            g = new a.AmFunnelChart(f);
            break;

          case "map":
            g = new a.AmMap(f);
            break;

          case "stock":
            g = new a.AmStockChart(f);
            break;

          case "gantt":
            g = new a.AmGanttChart(f);
        }
        a.extend(g, c);
        a.isReady ? isNaN(d) ? g.write(b) : setTimeout(function() {
            a.realWrite(g, b);
        }, d) : a.ready(function() {
            isNaN(d) ? g.write(b) : setTimeout(function() {
                a.realWrite(g, b);
            }, d);
        });
        return g;
    };
    a.realWrite = function(a, b) {
        a.write(b);
    };
    a.updateCount = 0;
    a.validateAt = Math.round(a.updateRate / 10);
    a.update = function() {
        var b = a.charts;
        a.updateCount++;
        var c = !1;
        a.updateCount == a.validateAt && (c = !0, a.updateCount = 0);
        if (b) for (var d = b.length - 1; 0 <= d; d--) b[d].update && b[d].update(), c && (b[d].autoResize ? b[d].validateSize && b[d].validateSize() : b[d].premeasure && b[d].premeasure());
        window.requestAnimationFrame && window.requestAnimationFrame(a.update);
    };
    a.bezierX = 3;
    a.bezierY = 6;
    "complete" == document.readyState && a.handleLoad();
}();

!function() {
    var a = window.AmCharts;
    a.toBoolean = function(a, b) {
        if (void 0 === a) return b;
        switch (String(a).toLowerCase()) {
          case "true":
          case "yes":
          case "1":
            return !0;

          case "false":
          case "no":
          case "0":
          case null:
            return !1;

          default:
            return !!a;
        }
    };
    a.removeFromArray = function(a, b) {
        var c;
        if (void 0 !== b && void 0 !== a) for (c = a.length - 1; 0 <= c; c--) a[c] == b && a.splice(c, 1);
    };
    a.getPath = function() {
        var a = document.getElementsByTagName("script");
        if (a) for (var b = 0; b < a.length; b++) {
            var c = a[b].src;
            if (-1 !== c.search(/\/(amcharts|ammap)\.js/)) return c.replace(/\/(amcharts|ammap)\.js.*/, "/");
        }
    };
    a.normalizeUrl = function(a) {
        return "" !== a && -1 === a.search(/\/$/) ? a + "/" : a;
    };
    a.isAbsolute = function(a) {
        return 0 === a.search(/^http[s]?:|^\//);
    };
    a.isInArray = function(a, b) {
        for (var c = 0; c < a.length; c++) if (a[c] == b) return !0;
        return !1;
    };
    a.getDecimals = function(a) {
        var b = 0;
        isNaN(a) || (a = String(a), -1 != a.indexOf("e-") ? b = Number(a.split("-")[1]) : -1 != a.indexOf(".") && (b = a.split(".")[1].length));
        return b;
    };
    a.wordwrap = function(b, c, d, e) {
        var f, g, h, i;
        b += "";
        if (1 > c) return b;
        f = -1;
        for (b = (i = b.split(/\r\n|\n|\r/)).length; ++f < b; i[f] += h) {
            h = i[f];
            for (i[f] = ""; h.length > c; i[f] += a.trim(h.slice(0, g)) + ((h = h.slice(g)).length ? d : "")) g = 2 == e || (g = h.slice(0, c + 1).match(/\S*(\s)?$/))[1] ? c : g.input.length - g[0].length || 1 == e && c || g.input.length + (g = h.slice(c).match(/^\S*/))[0].length;
            h = a.trim(h);
        }
        return i.join(d);
    };
    a.trim = function(a) {
        return a.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, "");
    };
    a.wrappedText = function(b, c, d, e, f, g, h, i) {
        var j = a.text(b, c, d, e, f, g, h);
        if (j) {
            var k = j.getBBox();
            if (k.width > i) {
                var l = "\n";
                a.isModern || (l = "<br>");
                i = Math.floor(i / (k.width / c.length));
                2 < i && (i -= 2);
                c = a.wordwrap(c, i, l, !0);
                j.remove();
                j = a.text(b, c, d, e, f, g, h);
            }
        }
        return j;
    };
    a.getStyle = function(a, b) {
        var c = "";
        if (document.defaultView && document.defaultView.getComputedStyle) try {
            c = document.defaultView.getComputedStyle(a, "").getPropertyValue(b);
        } catch (d) {} else a.currentStyle && (b = b.replace(/\-(\w)/g, function(a, b) {
            return b.toUpperCase();
        }), c = a.currentStyle[b]);
        return c;
    };
    a.removePx = function(a) {
        if (void 0 !== a) return Number(a.substring(0, a.length - 2));
    };
    a.getURL = function(b, c) {
        if (b) if ("_self" != c && c) if ("_top" == c && window.top) window.top.location.href = b; else if ("_parent" == c && window.parent) window.parent.location.href = b; else if ("_blank" == c) window.open(b); else {
            var d = document.getElementsByName(c)[0];
            d ? d.src = b : (d = a.windows[c]) ? d.opener && !d.opener.closed ? d.location.href = b : a.windows[c] = window.open(b) : a.windows[c] = window.open(b);
        } else window.location.href = b;
    };
    a.ifArray = function(a) {
        return a && "object" == typeof a && 0 < a.length ? !0 : !1;
    };
    a.callMethod = function(a, b) {
        var c;
        for (c = 0; c < b.length; c++) {
            var d = b[c];
            if (d) {
                if (d[a]) d[a]();
                var e = d.length;
                if (0 < e) {
                    var f;
                    for (f = 0; f < e; f++) {
                        var g = d[f];
                        if (g && g[a]) g[a]();
                    }
                }
            }
        }
    };
    a.toNumber = function(a) {
        return "number" == typeof a ? a : Number(String(a).replace(/[^0-9\-.]+/g, ""));
    };
    a.toColor = function(a) {
        if ("" !== a && void 0 !== a) if (-1 != a.indexOf(",")) {
            a = a.split(",");
            var b;
            for (b = 0; b < a.length; b++) {
                var c = a[b].substring(a[b].length - 6, a[b].length);
                a[b] = "#" + c;
            }
        } else a = a.substring(a.length - 6, a.length), a = "#" + a;
        return a;
    };
    a.toCoordinate = function(a, b, c) {
        var d;
        void 0 !== a && (a = String(a), c && c < b && (b = c), d = Number(a), -1 != a.indexOf("!") && (d = b - Number(a.substr(1))), 
        -1 != a.indexOf("%") && (d = b * Number(a.substr(0, a.length - 1)) / 100));
        return d;
    };
    a.fitToBounds = function(a, b, c) {
        a < b && (a = b);
        a > c && (a = c);
        return a;
    };
    a.isDefined = function(a) {
        return void 0 === a ? !1 : !0;
    };
    a.stripNumbers = function(a) {
        return a.replace(/[0-9]+/g, "");
    };
    a.roundTo = function(a, b) {
        if (0 > b) return a;
        var c = Math.pow(10, b);
        return Math.round(a * c) / c;
    };
    a.toFixed = function(a, b) {
        var c = String(Math.round(a * Math.pow(10, b)));
        if (0 < b) {
            var d = c.length;
            if (d < b) {
                var e;
                for (e = 0; e < b - d; e++) c = "0" + c;
            }
            d = c.substring(0, c.length - b);
            "" === d && (d = 0);
            return d + "." + c.substring(c.length - b, c.length);
        }
        return String(c);
    };
    a.formatDuration = function(b, c, d, e, f, g) {
        var h = a.intervals, i = g.decimalSeparator;
        if (b >= h[c].contains) {
            var j = b - Math.floor(b / h[c].contains) * h[c].contains;
            "ss" == c ? (j = a.formatNumber(j, g), 1 == j.split(i)[0].length && (j = "0" + j)) : j = a.roundTo(j, g.precision);
            ("mm" == c || "hh" == c) && 10 > j && (j = "0" + j);
            d = j + "" + e[c] + d;
            b = Math.floor(b / h[c].contains);
            c = h[c].nextInterval;
            return a.formatDuration(b, c, d, e, f, g);
        }
        "ss" == c && (b = a.formatNumber(b, g), 1 == b.split(i)[0].length && (b = "0" + b));
        ("mm" == c || "hh" == c) && 10 > b && (b = "0" + b);
        d = b + "" + e[c] + d;
        if (h[f].count > h[c].count) for (b = h[c].count; b < h[f].count; b++) c = h[c].nextInterval, 
        "ss" == c || "mm" == c || "hh" == c ? d = "00" + e[c] + d : "DD" == c && (d = "0" + e[c] + d);
        ":" == d.charAt(d.length - 1) && (d = d.substring(0, d.length - 1));
        return d;
    };
    a.formatNumber = function(b, c, d, e, f) {
        b = a.roundTo(b, c.precision);
        isNaN(d) && (d = c.precision);
        var g = c.decimalSeparator;
        c = c.thousandsSeparator;
        var h;
        h = 0 > b ? "-" : "";
        b = Math.abs(b);
        var i = String(b), j = !1;
        -1 != i.indexOf("e") && (j = !0);
        0 <= d && !j && (i = a.toFixed(b, d));
        var k = "";
        if (j) k = i; else {
            var i = i.split("."), j = String(i[0]), l;
            for (l = j.length; 0 <= l; l -= 3) k = l != j.length ? 0 !== l ? j.substring(l - 3, l) + c + k : j.substring(l - 3, l) + k : j.substring(l - 3, l);
            void 0 !== i[1] && (k = k + g + i[1]);
            void 0 !== d && 0 < d && "0" != k && (k = a.addZeroes(k, g, d));
        }
        k = h + k;
        "" === h && !0 === e && 0 !== b && (k = "+" + k);
        !0 === f && (k += "%");
        return k;
    };
    a.addZeroes = function(b, c, d) {
        b = b.split(c);
        void 0 === b[1] && 0 < d && (b[1] = "0");
        return b[1].length < d ? (b[1] += "0", a.addZeroes(b[0] + c + b[1], c, d)) : void 0 !== b[1] ? b[0] + c + b[1] : b[0];
    };
    a.scientificToNormal = function(a) {
        var b;
        a = String(a).split("e");
        var c;
        if ("-" == a[1].substr(0, 1)) {
            b = "0.";
            for (c = 0; c < Math.abs(Number(a[1])) - 1; c++) b += "0";
            b += a[0].split(".").join("");
        } else {
            var d = 0;
            b = a[0].split(".");
            b[1] && (d = b[1].length);
            b = a[0].split(".").join("");
            for (c = 0; c < Math.abs(Number(a[1])) - d; c++) b += "0";
        }
        return b;
    };
    a.toScientific = function(a, b) {
        if (0 === a) return "0";
        var c = Math.floor(Math.log(Math.abs(a)) * Math.LOG10E), d = String(d).split(".").join(b);
        return String(d) + "e" + c;
    };
    a.randomColor = function() {
        return "#" + ("00000" + (16777216 * Math.random() << 0).toString(16)).substr(-6);
    };
    a.hitTest = function(b, c, d) {
        var e = !1, f = b.x, g = b.x + b.width, h = b.y, i = b.y + b.height, j = a.isInRectangle;
        e || (e = j(f, h, c));
        e || (e = j(f, i, c));
        e || (e = j(g, h, c));
        e || (e = j(g, i, c));
        e || !0 === d || (e = a.hitTest(c, b, !0));
        return e;
    };
    a.isInRectangle = function(a, b, c) {
        return a >= c.x - 5 && a <= c.x + c.width + 5 && b >= c.y - 5 && b <= c.y + c.height + 5 ? !0 : !1;
    };
    a.isPercents = function(a) {
        if (-1 != String(a).indexOf("%")) return !0;
    };
    a.formatValue = function(b, c, d, e, f, g, h, i) {
        if (c) {
            void 0 === f && (f = "");
            var j;
            for (j = 0; j < d.length; j++) {
                var k = d[j], l = c[k];
                void 0 !== l && (l = g ? a.addPrefix(l, i, h, e) : a.formatNumber(l, e), b = b.replace(new RegExp("\\[\\[" + f + k + "\\]\\]", "g"), l));
            }
        }
        return b;
    };
    a.formatDataContextValue = function(a, b) {
        if (a) {
            var c = a.match(/\[\[.*?\]\]/g), d;
            for (d = 0; d < c.length; d++) {
                var e = c[d], e = e.substr(2, e.length - 4);
                void 0 !== b[e] && (a = a.replace(new RegExp("\\[\\[" + e + "\\]\\]", "g"), b[e]));
            }
        }
        return a;
    };
    a.massReplace = function(a, b) {
        for (var c in b) if (b.hasOwnProperty(c)) {
            var d = b[c];
            void 0 === d && (d = "");
            a = a.replace(c, d);
        }
        return a;
    };
    a.cleanFromEmpty = function(a) {
        return a.replace(/\[\[[^\]]*\]\]/g, "");
    };
    a.addPrefix = function(b, c, d, e, f) {
        var g = a.formatNumber(b, e), h = "", i, j, k;
        if (0 === b) return "0";
        0 > b && (h = "-");
        b = Math.abs(b);
        if (1 < b) {
            for (i = c.length - 1; -1 < i; i--) if (b >= c[i].number && (j = b / c[i].number, 
            k = Number(e.precision), 1 > k && (k = 1), d = a.roundTo(j, k), k = a.formatNumber(d, {
                precision: -1,
                decimalSeparator: e.decimalSeparator,
                thousandsSeparator: e.thousandsSeparator
            }), !f || j == d)) {
                g = h + "" + k + c[i].prefix;
                break;
            }
        } else for (i = 0; i < d.length; i++) if (b <= d[i].number) {
            j = b / d[i].number;
            k = Math.abs(Math.floor(Math.log(j) * Math.LOG10E));
            j = a.roundTo(j, k);
            g = h + "" + j + d[i].prefix;
            break;
        }
        return g;
    };
    a.remove = function(a) {
        a && a.remove();
    };
    a.getEffect = function(a) {
        ">" == a && (a = "easeOutSine");
        "<" == a && (a = "easeInSine");
        "elastic" == a && (a = "easeOutElastic");
        return a;
    };
    a.getObjById = function(a, b) {
        var c, d;
        for (d = 0; d < a.length; d++) {
            var e = a[d];
            if (e.id == b) {
                c = e;
                break;
            }
        }
        return c;
    };
    a.applyTheme = function(b, c, d) {
        c || (c = a.theme);
        c && c[d] && a.extend(b, c[d]);
    };
    a.isString = function(a) {
        return "string" == typeof a ? !0 : !1;
    };
    a.extend = function(a, b, c) {
        var d;
        a || (a = {});
        for (d in b) c ? a.hasOwnProperty(d) || (a[d] = b[d]) : a[d] = b[d];
        return a;
    };
    a.copyProperties = function(a, b) {
        for (var c in a) a.hasOwnProperty(c) && "events" != c && void 0 !== a[c] && "function" != typeof a[c] && "cname" != c && (b[c] = a[c]);
    };
    a.processObject = function(b, c, d, e) {
        if (!1 === b instanceof c && (b = e ? a.extend(new c(d), b) : a.extend(b, new c(d), !0), 
        b.listeners)) for (var f in b.listeners) c = b.listeners[f], b.addListener(c.event, c.method);
        return b;
    };
    a.fixNewLines = function(a) {
        var b = RegExp("\\n", "g");
        a && (a = a.replace(b, "<br />"));
        return a;
    };
    a.fixBrakes = function(b) {
        if (a.isModern) {
            var c = RegExp("<br>", "g");
            b && (b = b.replace(c, "\n"));
        } else b = a.fixNewLines(b);
        return b;
    };
    a.deleteObject = function(b, c) {
        if (b) {
            if (void 0 === c || null === c) c = 20;
            if (0 !== c) if ("[object Array]" === Object.prototype.toString.call(b)) for (var d = 0; d < b.length; d++) a.deleteObject(b[d], c - 1), 
            b[d] = null; else if (b && !b.tagName) try {
                for (d in b) b[d] && ("object" == typeof b[d] && a.deleteObject(b[d], c - 1), "function" != typeof b[d] && (b[d] = null));
            } catch (e) {}
        }
    };
    a.bounce = function(a, b, c, d, e) {
        return (b /= e) < 1 / 2.75 ? 7.5625 * d * b * b + c : b < 2 / 2.75 ? d * (7.5625 * (b -= 1.5 / 2.75) * b + .75) + c : b < 2.5 / 2.75 ? d * (7.5625 * (b -= 2.25 / 2.75) * b + .9375) + c : d * (7.5625 * (b -= 2.625 / 2.75) * b + .984375) + c;
    };
    a.easeInOutQuad = function(a, b, c, d, e) {
        b /= e / 2;
        if (1 > b) return d / 2 * b * b + c;
        b--;
        return -d / 2 * (b * (b - 2) - 1) + c;
    };
    a.easeInSine = function(a, b, c, d, e) {
        return -d * Math.cos(b / e * (Math.PI / 2)) + d + c;
    };
    a.easeOutSine = function(a, b, c, d, e) {
        return d * Math.sin(b / e * (Math.PI / 2)) + c;
    };
    a.easeOutElastic = function(a, b, c, d, e) {
        a = 1.70158;
        var f = 0, g = d;
        if (0 === b) return c;
        if (1 == (b /= e)) return c + d;
        f || (f = .3 * e);
        g < Math.abs(d) ? (g = d, a = f / 4) : a = f / (2 * Math.PI) * Math.asin(d / g);
        return g * Math.pow(2, -10 * b) * Math.sin(2 * (b * e - a) * Math.PI / f) + d + c;
    };
    a.fixStepE = function(b) {
        b = b.toExponential(0).split("e");
        var c = Number(b[1]);
        9 == Number(b[0]) && c++;
        return a.generateNumber(1, c);
    };
    a.generateNumber = function(a, b) {
        var c = "", d;
        d = 0 > b ? Math.abs(b) - 1 : Math.abs(b);
        var e;
        for (e = 0; e < d; e++) c += "0";
        return 0 > b ? Number("0." + c + String(a)) : Number(String(a) + c);
    };
    a.setCN = function(a, b, c, d) {
        if (a.addClassNames && b && (b = b.node) && c) {
            var e = b.getAttribute("class");
            a = a.classNamePrefix + "-";
            d && (a = "");
            e ? b.setAttribute("class", e + " " + a + c) : b.setAttribute("class", a + c);
        }
    };
    a.parseDefs = function(b, c) {
        for (var d in b) {
            var e = typeof b[d];
            if (0 < b[d].length && "object" == e) for (var f = 0; f < b[d].length; f++) e = document.createElementNS(a.SVG_NS, d), 
            c.appendChild(e), a.parseDefs(b[d][f], e); else "object" == e ? (e = document.createElementNS(a.SVG_NS, d), 
            c.appendChild(e), a.parseDefs(b[d], e)) : c.setAttribute(d, b[d]);
        }
    };
}();

!function() {
    var a = window.AmCharts;
    a.AxisBase = a.Class({
        construct: function(b) {
            this.createEvents("clickItem", "rollOverItem", "rollOutItem");
            this.titleDY = this.y = this.x = this.dy = this.dx = 0;
            this.axisThickness = 1;
            this.axisColor = "#000000";
            this.axisAlpha = 1;
            this.gridCount = this.tickLength = 5;
            this.gridAlpha = .15;
            this.gridThickness = 1;
            this.gridColor = "#000000";
            this.dashLength = 0;
            this.labelFrequency = 1;
            this.showLastLabel = this.showFirstLabel = !0;
            this.fillColor = "#FFFFFF";
            this.fillAlpha = 0;
            this.labelsEnabled = !0;
            this.labelRotation = 0;
            this.autoGridCount = !0;
            this.offset = 0;
            this.guides = [];
            this.visible = !0;
            this.counter = 0;
            this.guides = [];
            this.ignoreAxisWidth = this.inside = !1;
            this.minHorizontalGap = 75;
            this.minVerticalGap = 35;
            this.titleBold = !0;
            this.minorGridEnabled = !1;
            this.minorGridAlpha = .07;
            this.autoWrap = !1;
            this.titleAlign = "middle";
            this.labelOffset = 0;
            this.bcn = "axis-";
            this.centerLabels = !1;
            this.firstDayOfWeek = 1;
            this.centerLabelOnFullPeriod = this.markPeriodChange = this.boldPeriodBeginning = !0;
            this.periods = [ {
                period: "ss",
                count: 1
            }, {
                period: "ss",
                count: 5
            }, {
                period: "ss",
                count: 10
            }, {
                period: "ss",
                count: 30
            }, {
                period: "mm",
                count: 1
            }, {
                period: "mm",
                count: 5
            }, {
                period: "mm",
                count: 10
            }, {
                period: "mm",
                count: 30
            }, {
                period: "hh",
                count: 1
            }, {
                period: "hh",
                count: 3
            }, {
                period: "hh",
                count: 6
            }, {
                period: "hh",
                count: 12
            }, {
                period: "DD",
                count: 1
            }, {
                period: "DD",
                count: 2
            }, {
                period: "DD",
                count: 3
            }, {
                period: "DD",
                count: 4
            }, {
                period: "DD",
                count: 5
            }, {
                period: "WW",
                count: 1
            }, {
                period: "MM",
                count: 1
            }, {
                period: "MM",
                count: 2
            }, {
                period: "MM",
                count: 3
            }, {
                period: "MM",
                count: 6
            }, {
                period: "YYYY",
                count: 1
            }, {
                period: "YYYY",
                count: 2
            }, {
                period: "YYYY",
                count: 5
            }, {
                period: "YYYY",
                count: 10
            }, {
                period: "YYYY",
                count: 50
            }, {
                period: "YYYY",
                count: 100
            } ];
            this.dateFormats = [ {
                period: "fff",
                format: "JJ:NN:SS"
            }, {
                period: "ss",
                format: "JJ:NN:SS"
            }, {
                period: "mm",
                format: "JJ:NN"
            }, {
                period: "hh",
                format: "JJ:NN"
            }, {
                period: "DD",
                format: "MMM DD"
            }, {
                period: "WW",
                format: "MMM DD"
            }, {
                period: "MM",
                format: "MMM"
            }, {
                period: "YYYY",
                format: "YYYY"
            } ];
            this.nextPeriod = {
                fff: "ss",
                ss: "mm",
                mm: "hh",
                hh: "DD",
                DD: "MM",
                MM: "YYYY"
            };
            a.applyTheme(this, b, "AxisBase");
        },
        zoom: function(a, b) {
            this.start = a;
            this.end = b;
            this.dataChanged = !0;
            this.draw();
        },
        fixAxisPosition: function() {
            var a = this.position;
            "H" == this.orientation ? ("left" == a && (a = "bottom"), "right" == a && (a = "top")) : ("bottom" == a && (a = "left"), 
            "top" == a && (a = "right"));
            this.position = a;
        },
        init: function() {
            this.createBalloon();
        },
        draw: function() {
            var a = this.chart;
            this.prevBY = this.prevBX = 0/0;
            this.allLabels = [];
            this.counter = 0;
            this.destroy();
            this.fixAxisPosition();
            this.setBalloonBounds();
            this.labels = [];
            var b = a.container, c = b.set();
            a.gridSet.push(c);
            this.set = c;
            b = b.set();
            a.axesLabelsSet.push(b);
            this.labelsSet = b;
            this.axisLine = new this.axisRenderer(this);
            this.autoGridCount ? ("V" == this.orientation ? (a = this.height / this.minVerticalGap, 
            3 > a && (a = 3)) : a = this.width / this.minHorizontalGap, this.gridCountR = Math.max(a, 1)) : this.gridCountR = this.gridCount;
            this.axisWidth = this.axisLine.axisWidth;
            this.addTitle();
        },
        setOrientation: function(a) {
            this.orientation = a ? "H" : "V";
        },
        addTitle: function() {
            var b = this.title;
            this.titleLabel = null;
            if (b) {
                var c = this.chart, d = this.titleColor;
                void 0 === d && (d = c.color);
                var e = this.titleFontSize;
                isNaN(e) && (e = c.fontSize + 1);
                b = a.text(c.container, b, d, c.fontFamily, e, this.titleAlign, this.titleBold);
                a.setCN(c, b, this.bcn + "title");
                this.titleLabel = b;
            }
        },
        positionTitle: function() {
            var b = this.titleLabel;
            if (b) {
                var c, d, e = this.labelsSet, f = {};
                0 < e.length() ? f = e.getBBox() : (f.x = 0, f.y = 0, f.width = this.width, f.height = this.height, 
                a.VML && (f.y += this.y, f.x += this.x));
                e.push(b);
                var e = f.x, g = f.y;
                a.VML && (this.rotate ? e -= this.x : g -= this.y);
                var h = f.width, f = f.height, i = this.width, j = this.height, k = 0, l = b.getBBox().height / 2, m = this.inside, n = this.titleAlign;
                switch (this.position) {
                  case "top":
                    c = "left" == n ? -1 : "right" == n ? i : i / 2;
                    d = g - 10 - l;
                    break;

                  case "bottom":
                    c = "left" == n ? -1 : "right" == n ? i : i / 2;
                    d = g + f + 10 + l;
                    break;

                  case "left":
                    c = e - 10 - l;
                    m && (c -= 5);
                    k = -90;
                    d = ("left" == n ? j + 1 : "right" == n ? -1 : j / 2) + this.titleDY;
                    break;

                  case "right":
                    c = e + h + 10 + l, m && (c += 7), d = ("left" == n ? j + 2 : "right" == n ? -2 : j / 2) + this.titleDY, 
                    k = -90;
                }
                this.marginsChanged ? (b.translate(c, d), this.tx = c, this.ty = d) : b.translate(this.tx, this.ty);
                this.marginsChanged = !1;
                isNaN(this.titleRotation) || (k = this.titleRotation);
                0 !== k && b.rotate(k);
            }
        },
        pushAxisItem: function(a, b) {
            var c = this, d = a.graphics();
            0 < d.length() && (b ? c.labelsSet.push(d) : c.set.push(d));
            if (d = a.getLabel()) this.labelsSet.push(d), d.click(function(b) {
                c.handleMouse(b, a, "clickItem");
            }).mouseover(function(b) {
                c.handleMouse(b, a, "rollOverItem");
            }).mouseout(function(b) {
                c.handleMouse(b, a, "rollOutItem");
            });
        },
        handleMouse: function(a, b, c) {
            this.fire({
                type: c,
                value: b.value,
                serialDataItem: b.serialDataItem,
                axis: this,
                target: b.label,
                chart: this.chart,
                event: a
            });
        },
        addGuide: function(b) {
            for (var c = this.guides, d = !1, e = c.length, f = 0; f < c.length; f++) c[f] == b && (d = !0, 
            e = f);
            b = a.processObject(b, a.Guide, this.theme);
            b.id || (b.id = "guideAuto" + e + "_" + new Date().getTime());
            d || c.push(b);
        },
        removeGuide: function(a) {
            var b = this.guides, c;
            for (c = 0; c < b.length; c++) b[c] == a && b.splice(c, 1);
        },
        handleGuideOver: function(a) {
            clearTimeout(this.chart.hoverInt);
            var b = a.graphics.getBBox(), c = this.x + b.x + b.width / 2, b = this.y + b.y + b.height / 2, d = a.fillColor;
            void 0 === d && (d = a.lineColor);
            this.chart.showBalloon(a.balloonText, d, !0, c, b);
        },
        handleGuideOut: function() {
            this.chart.hideBalloon();
        },
        addEventListeners: function(a, b) {
            var c = this;
            a.mouseover(function() {
                c.handleGuideOver(b);
            });
            a.touchstart(function() {
                c.handleGuideOver(b);
            });
            a.mouseout(function() {
                c.handleGuideOut(b);
            });
        },
        getBBox: function() {
            var b;
            this.labelsSet && (b = this.labelsSet.getBBox());
            b ? a.VML || (b = {
                x: b.x + this.x,
                y: b.y + this.y,
                width: b.width,
                height: b.height
            }) : b = {
                x: 0,
                y: 0,
                width: 0,
                height: 0
            };
            return b;
        },
        destroy: function() {
            a.remove(this.set);
            a.remove(this.labelsSet);
            var b = this.axisLine;
            b && a.remove(b.axisSet);
            a.remove(this.grid0);
        },
        chooseMinorFrequency: function(a) {
            for (var b = 10; 0 < b; b--) if (a / b == Math.round(a / b)) return a / b;
        },
        parseDatesDraw: function() {
            var b, c = this.chart, d = this.showFirstLabel, e = this.showLastLabel, f, g = "", h = a.extractPeriod(this.minPeriod), i = a.getPeriodDuration(h.period, h.count), j, k, l, m, n, o = this.firstDayOfWeek, p = this.boldPeriodBeginning;
            b = this.minorGridEnabled;
            var q, r = this.gridAlpha, s, t = this.choosePeriod(0), u = t.period, t = t.count, v = a.getPeriodDuration(u, t);
            v < i && (u = h.period, t = h.count, v = i);
            h = u;
            "WW" == h && (h = "DD");
            this.stepWidth = this.getStepWidth(this.timeDifference);
            var w = Math.ceil(this.timeDifference / v) + 5, x = j = a.resetDateToMin(new Date(this.startTime - v), u, t, o).getTime();
            if (h == u && 1 == t && this.centerLabelOnFullPeriod || this.autoWrap || this.centerLabels) l = v * this.stepWidth, 
            this.autoWrap && !this.centerLabels && (l = -l);
            this.cellWidth = i * this.stepWidth;
            m = Math.round(j / v);
            i = -1;
            m / 2 == Math.round(m / 2) && (i = -2, j -= v);
            m = this.firstTime;
            var y = 0, z = 0;
            b && 1 < t && (q = this.chooseMinorFrequency(t), s = a.getPeriodDuration(u, q), 
            "DD" == u && (s += a.getPeriodDuration("hh")));
            if (0 < this.gridCountR) for (w - 5 - i > this.autoRotateCount && !isNaN(this.autoRotateAngle) && (this.labelRotationR = this.autoRotateAngle), 
            b = i; b <= w; b++) {
                n = m + v * (b + Math.floor((x - m) / v)) - y;
                "DD" == u && (n += 36e5);
                n = a.resetDateToMin(new Date(n), u, t, o).getTime();
                "MM" == u && (f = (n - j) / v, 1.5 <= (n - j) / v && (n = n - (f - 1) * v + a.getPeriodDuration("DD", 3), 
                n = a.resetDateToMin(new Date(n), u, 1).getTime(), y += v));
                f = (n - this.startTime) * this.stepWidth;
                if ("radar" == c.type) {
                    if (f = this.axisWidth - f, 0 > f || f > this.axisWidth) continue;
                } else this.rotate ? "date" == this.type && "middle" == this.gridPosition && (z = -v * this.stepWidth / 2) : "date" == this.type && (f = this.axisWidth - f);
                g = !1;
                this.nextPeriod[h] && (g = this.checkPeriodChange(this.nextPeriod[h], 1, n, j, h));
                j = !1;
                g && this.markPeriodChange ? (g = this.dateFormatsObject[this.nextPeriod[h]], this.twoLineMode && (g = this.dateFormatsObject[h] + "\n" + g, 
                g = a.fixBrakes(g)), j = !0) : g = this.dateFormatsObject[h];
                p || (j = !1);
                this.currentDateFormat = g;
                g = a.formatDate(new Date(n), g, c);
                if (b == i && !d || b == w && !e) g = " ";
                this.labelFunction && (g = this.labelFunction(g, new Date(n), this, u, t, k).toString());
                this.boldLabels && (j = !0);
                k = new this.axisItemRenderer(this, f, g, !1, l, z, !1, j);
                this.pushAxisItem(k);
                k = j = n;
                if (!isNaN(q)) for (f = 1; f < t; f += q) this.gridAlpha = this.minorGridAlpha, 
                g = n + s * f, g = a.resetDateToMin(new Date(g), u, q, o).getTime(), g = new this.axisItemRenderer(this, (g - this.startTime) * this.stepWidth, void 0, void 0, void 0, void 0, void 0, void 0, void 0, !0), 
                this.pushAxisItem(g);
                this.gridAlpha = r;
            }
        },
        choosePeriod: function(b) {
            var c = a.getPeriodDuration(this.periods[b].period, this.periods[b].count), d = this.periods;
            return this.timeDifference < c && 0 < b ? d[b - 1] : Math.ceil(this.timeDifference / c) <= this.gridCountR ? d[b] : b + 1 < d.length ? this.choosePeriod(b + 1) : d[b];
        },
        getStepWidth: function(a) {
            var b;
            this.startOnAxis ? (b = this.axisWidth / (a - 1), 1 == a && (b = this.axisWidth)) : b = this.axisWidth / a;
            return b;
        },
        timeZoom: function(a, b) {
            this.startTime = a;
            this.endTime = b;
        },
        minDuration: function() {
            var b = a.extractPeriod(this.minPeriod);
            return a.getPeriodDuration(b.period, b.count);
        },
        checkPeriodChange: function(b, c, d, e, f) {
            d = new Date(d);
            var g = new Date(e), h = this.firstDayOfWeek;
            e = c;
            "DD" == b && (c = 1);
            d = a.resetDateToMin(d, b, c, h).getTime();
            c = a.resetDateToMin(g, b, c, h).getTime();
            return "DD" == b && "hh" != f && d - c < a.getPeriodDuration(b, e) ? !1 : d != c ? !0 : !1;
        },
        generateDFObject: function() {
            this.dateFormatsObject = {};
            var a;
            for (a = 0; a < this.dateFormats.length; a++) {
                var b = this.dateFormats[a];
                this.dateFormatsObject[b.period] = b.format;
            }
        },
        hideBalloon: function() {
            this.balloon && this.balloon.hide && this.balloon.hide();
            this.prevBY = this.prevBX = 0/0;
        },
        formatBalloonText: function(a) {
            return a;
        },
        showBalloon: function(a, b, c, d) {
            var e = this.offset;
            switch (this.position) {
              case "bottom":
                b = this.height + e;
                break;

              case "top":
                b = -e;
                break;

              case "left":
                a = -e;
                break;

              case "right":
                a = this.width + e;
            }
            c || (c = this.currentDateFormat);
            if ("V" == this.orientation) {
                if (0 > b || b > this.height) return;
                if (isNaN(b)) {
                    this.hideBalloon();
                    return;
                }
                b = this.adjustBalloonCoordinate(b, d);
                d = this.coordinateToValue(b);
            } else {
                if (0 > a || a > this.width) return;
                if (isNaN(a)) {
                    this.hideBalloon();
                    return;
                }
                a = this.adjustBalloonCoordinate(a, d);
                d = this.coordinateToValue(a);
            }
            var f;
            if (e = this.chart.chartCursor) f = e.index;
            if (this.balloon && void 0 !== d && this.balloon.enabled) {
                if (this.balloonTextFunction) {
                    if ("date" == this.type || !0 === this.parseDates) d = new Date(d);
                    d = this.balloonTextFunction(d);
                } else this.balloonText ? d = this.formatBalloonText(this.balloonText, f, c) : isNaN(d) || (d = this.formatValue(d, c));
                if (a != this.prevBX || b != this.prevBY) this.balloon.setPosition(a, b), this.prevBX = a, 
                this.prevBY = b, d && this.balloon.showBalloon(d);
            }
        },
        adjustBalloonCoordinate: function(a) {
            return a;
        },
        createBalloon: function() {
            var b = this.chart, c = b.chartCursor;
            c && (c = c.cursorPosition, "mouse" != c && (this.stickBalloonToCategory = !0), 
            "start" == c && (this.stickBalloonToStart = !0), "ValueAxis" == this.cname && (this.stickBalloonToCategory = !1));
            this.balloon && (this.balloon.destroy && this.balloon.destroy(), a.extend(this.balloon, b.balloon, !0));
        },
        setBalloonBounds: function() {
            var a = this.balloon;
            if (a) {
                var b = this.chart;
                a.cornerRadius = 0;
                a.shadowAlpha = 0;
                a.borderThickness = 1;
                a.borderAlpha = 1;
                a.adjustBorderColor = !1;
                a.showBullet = !1;
                this.balloon = a;
                a.chart = b;
                a.mainSet = b.plotBalloonsSet;
                a.pointerWidth = this.tickLength;
                if (this.parseDates || "date" == this.type) a.pointerWidth = 0;
                a.className = this.id;
                b = "V";
                "V" == this.orientation && (b = "H");
                this.stickBalloonToCategory || (a.animationDuration = 0);
                var c, d, e, f, g = this.inside, h = this.width, i = this.height;
                switch (this.position) {
                  case "bottom":
                    c = 0;
                    d = h;
                    g ? (e = 0, f = i) : (e = i, f = i + 1e3);
                    break;

                  case "top":
                    c = 0;
                    d = h;
                    g ? (e = 0, f = i) : (e = -1e3, f = 0);
                    break;

                  case "left":
                    e = 0;
                    f = i;
                    g ? (c = 0, d = h) : (c = -1e3, d = 0);
                    break;

                  case "right":
                    e = 0, f = i, g ? (c = 0, d = h) : (c = h, d = h + 1e3);
                }
                a.drop || (a.pointerOrientation = b);
                a.setBounds(c, e, d, f);
            }
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.ValueAxis = a.Class({
        inherits: a.AxisBase,
        construct: function(b) {
            this.cname = "ValueAxis";
            this.createEvents("axisChanged", "logarithmicAxisFailed", "axisZoomed", "axisIntZoomed");
            a.ValueAxis.base.construct.call(this, b);
            this.dataChanged = !0;
            this.stackType = "none";
            this.position = "left";
            this.unitPosition = "right";
            this.includeAllValues = this.recalculateToPercents = this.includeHidden = this.includeGuidesInMinMax = this.integersOnly = !1;
            this.durationUnits = {
                DD: "d. ",
                hh: ":",
                mm: ":",
                ss: ""
            };
            this.scrollbar = !1;
            this.baseValue = 0;
            this.radarCategoriesEnabled = !0;
            this.axisFrequency = 1;
            this.gridType = "polygons";
            this.useScientificNotation = !1;
            this.axisTitleOffset = 10;
            this.pointPosition = "axis";
            this.minMaxMultiplier = 1;
            this.logGridLimit = 2;
            this.totalTextOffset = this.treatZeroAs = 0;
            this.minPeriod = "ss";
            this.relativeStart = 0;
            this.relativeEnd = 1;
            a.applyTheme(this, b, this.cname);
        },
        updateData: function() {
            0 >= this.gridCountR && (this.gridCountR = 1);
            this.totals = [];
            this.data = this.chart.chartData;
            var b = this.chart;
            "xy" != b.type && (this.stackGraphs("smoothedLine"), this.stackGraphs("line"), this.stackGraphs("column"), 
            this.stackGraphs("step"));
            this.recalculateToPercents && this.recalculate();
            this.synchronizationMultiplier && this.synchronizeWith ? (a.isString(this.synchronizeWith) && (this.synchronizeWith = b.getValueAxisById(this.synchronizeWith)), 
            this.synchronizeWith && (this.synchronizeWithAxis(this.synchronizeWith), this.foundGraphs = !0)) : (this.foundGraphs = !1, 
            this.getMinMax(), 0 === this.start && this.end == this.data.length - 1 && isNaN(this.minZoom) && isNaN(this.maxZoom) && (this.fullMin = this.min, 
            this.fullMax = this.max, "date" != this.type && (isNaN(this.minimum) || (this.fullMin = this.minimum), 
            isNaN(this.maximum) || (this.fullMax = this.maximum)), this.logarithmic && (this.fullMin = this.logMin, 
            0 === this.fullMin && (this.fullMin = this.treatZeroAs)), "date" == this.type && (this.minimumDate || (this.fullMin = this.minRR), 
            this.maximumDate || (this.fullMax = this.maxRR))));
        },
        draw: function() {
            a.ValueAxis.base.draw.call(this);
            var b = this.chart, c = this.set;
            this.labelRotationR = this.labelRotation;
            a.setCN(b, this.set, "value-axis value-axis-" + this.id);
            a.setCN(b, this.labelsSet, "value-axis value-axis-" + this.id);
            a.setCN(b, this.axisLine.axisSet, "value-axis value-axis-" + this.id);
            var d = this.type;
            "duration" == d && (this.duration = "ss");
            !0 === this.dataChanged && (this.updateData(), this.dataChanged = !1);
            "date" == d && (this.logarithmic = !1, this.min = this.minRR, this.max = this.maxRR, 
            this.reversed = !1, this.getDateMinMax());
            if (this.logarithmic) {
                var e = this.treatZeroAs, f = this.getExtremes(0, this.data.length - 1).min;
                !isNaN(this.minimum) && this.minimum < f && (f = this.minimum);
                this.logMin = f;
                this.minReal < f && (this.minReal = f);
                isNaN(this.minReal) && (this.minReal = f);
                0 < e && 0 === f && (this.minReal = f = e);
                if (0 >= f || 0 >= this.minimum) {
                    this.fire({
                        type: "logarithmicAxisFailed",
                        chart: b
                    });
                    return;
                }
            }
            this.grid0 = null;
            var g, h, i = b.dx, j = b.dy, e = !1, f = this.logarithmic;
            if (isNaN(this.min) || isNaN(this.max) || !this.foundGraphs || 1/0 == this.min || -1/0 == this.max) e = !0; else {
                "date" == this.type && this.min == this.max && (this.max += this.minDuration(), 
                this.min -= this.minDuration());
                var k = this.labelFrequency, l = this.showFirstLabel, m = this.showLastLabel, n = 1, o = 0;
                this.minCalc = this.min;
                this.maxCalc = this.max;
                this.strictMinMax && (isNaN(this.minimum) || (this.min = this.minimum), isNaN(this.maximum) || (this.max = this.maximum));
                isNaN(this.minZoom) || (this.minReal = this.min = this.minZoom);
                isNaN(this.maxZoom) || (this.max = this.maxZoom);
                if (this.logarithmic) {
                    h = Math.log(this.fullMax) * Math.LOG10E - Math.log(this.fullMin) * Math.LOG10E;
                    var p = Math.log(this.max) / Math.LN10 - Math.log(this.fullMin) * Math.LOG10E;
                    this.relativeStart = (Math.log(this.minReal) / Math.LN10 - Math.log(this.fullMin) * Math.LOG10E) / h;
                    this.relativeEnd = p / h;
                } else this.relativeStart = a.fitToBounds((this.min - this.fullMin) / (this.fullMax - this.fullMin), 0, 1), 
                this.relativeEnd = a.fitToBounds((this.max - this.fullMin) / (this.fullMax - this.fullMin), 0, 1);
                var p = Math.round((this.maxCalc - this.minCalc) / this.step) + 1, q;
                !0 === f ? (q = Math.log(this.max) * Math.LOG10E - Math.log(this.minReal) * Math.LOG10E, 
                this.stepWidth = this.axisWidth / q, q > this.logGridLimit && (p = Math.ceil(Math.log(this.max) * Math.LOG10E) + 1, 
                o = Math.round(Math.log(this.minReal) * Math.LOG10E), p > this.gridCountR && (n = Math.ceil(p / this.gridCountR)))) : this.stepWidth = this.axisWidth / (this.max - this.min);
                var r = 0;
                1 > this.step && -1 < this.step && (r = a.getDecimals(this.step));
                this.integersOnly && (r = 0);
                r > this.maxDecCount && (r = this.maxDecCount);
                var s = this.precision;
                isNaN(s) || (r = s);
                isNaN(this.maxZoom) && (this.max = a.roundTo(this.max, this.maxDecCount), this.min = a.roundTo(this.min, this.maxDecCount));
                h = {};
                h.precision = r;
                h.decimalSeparator = b.nf.decimalSeparator;
                h.thousandsSeparator = b.nf.thousandsSeparator;
                this.numberFormatter = h;
                this.exponential = !1;
                for (h = o; h < p; h += n) {
                    var t = a.roundTo(this.step * h + this.min, r);
                    -1 != String(t).indexOf("e") && (this.exponential = !0);
                }
                this.duration && (this.maxInterval = a.getMaxInterval(this.max, this.duration));
                var r = this.step, u, t = this.minorGridAlpha;
                this.minorGridEnabled && (u = this.getMinorGridStep(r, this.stepWidth * r));
                if (this.autoGridCount || 0 !== this.gridCount) if ("date" == d) this.generateDFObject(), 
                this.timeDifference = this.max - this.min, this.maxTime = this.lastTime = this.max, 
                this.startTime = this.firstTime = this.min, this.parseDatesDraw(); else for (p >= this.autoRotateCount && !isNaN(this.autoRotateAngle) && (this.labelRotationR = this.autoRotateAngle), 
                f && p++, h = o; h < p; h += n) if (d = r * h + this.minCalc, d = a.roundTo(d, this.maxDecCount + 1), 
                !this.integersOnly || Math.round(d) == d) if (isNaN(s) || Number(a.toFixed(d, s)) == d) {
                    !0 === f && (0 === d && (d = this.minReal), q > this.logGridLimit && (d = Math.pow(10, h)));
                    o = this.formatValue(d, !1, h);
                    Math.round(h / k) != h / k && (o = void 0);
                    if (0 === h && !l || h == p - 1 && !m) o = " ";
                    g = this.getCoordinate(d);
                    var v;
                    this.rotate && this.autoWrap && (v = this.stepWidth * r - 10);
                    o = new this.axisItemRenderer(this, g, o, void 0, v, void 0, void 0, this.boldLabels);
                    this.pushAxisItem(o);
                    if (d == this.baseValue && "radar" != b.type) {
                        var w, x, o = this.width, y = this.height;
                        "H" == this.orientation ? 0 <= g && g <= o + 1 && (w = [ g, g, g + i ], x = [ y, 0, j ]) : 0 <= g && g <= y + 1 && (w = [ 0, o, o + i ], 
                        x = [ g, g, g + j ]);
                        w && (o = a.fitToBounds(2 * this.gridAlpha, 0, 1), isNaN(this.zeroGridAlpha) || (o = this.zeroGridAlpha), 
                        o = a.line(b.container, w, x, this.gridColor, o, 1, this.dashLength), o.translate(this.x, this.y), 
                        this.grid0 = o, b.axesSet.push(o), o.toBack(), a.setCN(b, o, this.bcn + "zero-grid-" + this.id), 
                        a.setCN(b, o, this.bcn + "zero-grid"));
                    }
                    if (!isNaN(u) && 0 < t && h < p - 1) {
                        o = r / u;
                        f && (u = r * (h + n) + this.minCalc, u = a.roundTo(u, this.maxDecCount + 1), q > this.logGridLimit && (u = Math.pow(10, h + n)), 
                        o = 9, u = (u - d) / o);
                        g = this.gridAlpha;
                        this.gridAlpha = this.minorGridAlpha;
                        for (y = 1; y < o; y++) {
                            var z = this.getCoordinate(d + u * y), z = new this.axisItemRenderer(this, z, "", !1, 0, 0, !1, !1, 0, !0);
                            this.pushAxisItem(z);
                        }
                        this.gridAlpha = g;
                    }
                }
                q = this.guides;
                v = q.length;
                if (0 < v) {
                    w = this.fillAlpha;
                    for (h = this.fillAlpha = 0; h < v; h++) x = q[h], i = 0/0, u = x.above, isNaN(x.toValue) || (i = this.getCoordinate(x.toValue), 
                    o = new this.axisItemRenderer(this, i, "", !0, 0/0, 0/0, x), this.pushAxisItem(o, u)), 
                    j = 0/0, isNaN(x.value) || (j = this.getCoordinate(x.value), o = new this.axisItemRenderer(this, j, x.label, !0, 0/0, (i - j) / 2, x), 
                    this.pushAxisItem(o, u)), isNaN(i) && (j -= 3, i = j + 3), isNaN(i - j) || 0 > j && 0 > i || (i = new this.guideFillRenderer(this, j, i, x), 
                    this.pushAxisItem(i, u), u = i.graphics(), x.graphics = u, x.balloonText && this.addEventListeners(u, x));
                    this.fillAlpha = w;
                }
                h = this.baseValue;
                this.min > this.baseValue && this.max > this.baseValue && (h = this.min);
                this.min < this.baseValue && this.max < this.baseValue && (h = this.max);
                f && h < this.minReal && (h = this.minReal);
                this.baseCoord = this.getCoordinate(h, !0);
                h = {
                    type: "axisChanged",
                    target: this,
                    chart: b
                };
                h.min = f ? this.minReal : this.min;
                h.max = this.max;
                this.fire(h);
                this.axisCreated = !0;
            }
            f = this.axisLine.set;
            h = this.labelsSet;
            c.translate(this.x, this.y);
            h.translate(this.x, this.y);
            this.positionTitle();
            "radar" != b.type && f.toFront();
            !this.visible || e ? (c.hide(), f.hide(), h.hide()) : (c.show(), f.show(), h.show());
            this.axisY = this.y;
            this.axisX = this.x;
        },
        getDateMinMax: function() {
            this.minimumDate && (this.minimumDate instanceof Date || (this.minimumDate = a.getDate(this.minimumDate, this.chart.dataDateFormat, "fff")), 
            this.min = this.minimumDate.getTime());
            this.maximumDate && (this.maximumDate instanceof Date || (this.maximumDate = a.getDate(this.maximumDate, this.chart.dataDateFormat, "fff")), 
            this.max = this.maximumDate.getTime());
        },
        formatValue: function(b, c, d) {
            var e = this.exponential, f = this.logarithmic, g = this.numberFormatter, h = this.chart;
            if (g) return !0 === this.logarithmic && (e = -1 != String(b).indexOf("e") ? !0 : !1), 
            this.useScientificNotation && (e = !0), this.usePrefixes && (e = !1), e ? (d = -1 == String(b).indexOf("e") ? b.toExponential(15) : String(b), 
            e = d.split("e"), d = Number(e[0]), e = Number(e[1]), d = a.roundTo(d, 14), 10 == d && (d = 1, 
            e += 1), d = d + "e" + e, 0 === b && (d = "0"), 1 == b && (d = "1")) : (f && (e = String(b).split("."), 
            e[1] ? (g.precision = e[1].length, 0 > d && (g.precision = Math.abs(d)), c && 1 < b && (g.precision = 0)) : g.precision = -1), 
            d = this.usePrefixes ? a.addPrefix(b, h.prefixesOfBigNumbers, h.prefixesOfSmallNumbers, g, !c) : a.formatNumber(b, g, g.precision)), 
            this.duration && (c && (g.precision = 0), d = a.formatDuration(b, this.duration, "", this.durationUnits, this.maxInterval, g)), 
            "date" == this.type && (d = a.formatDate(new Date(b), this.currentDateFormat, h)), 
            this.recalculateToPercents ? d += "%" : (c = this.unit) && (d = "left" == this.unitPosition ? c + d : d + c), 
            this.labelFunction && (d = "date" == this.type ? this.labelFunction(d, new Date(b), this).toString() : this.labelFunction(b, d, this).toString()), 
            d;
        },
        getMinorGridStep: function(a, b) {
            var c = [ 5, 4, 2 ];
            60 > b && c.shift();
            for (var d = Math.floor(Math.log(Math.abs(a)) * Math.LOG10E), e = 0; e < c.length; e++) {
                var f = a / c[e], g = Math.floor(Math.log(Math.abs(f)) * Math.LOG10E);
                if (!(1 < Math.abs(d - g))) if (1 > a) {
                    if (g = Math.pow(10, -g) * f, g == Math.round(g)) return f;
                } else if (f == Math.round(f)) return f;
            }
        },
        stackGraphs: function(b) {
            var c = this.stackType;
            "stacked" == c && (c = "regular");
            "line" == c && (c = "none");
            "100% stacked" == c && (c = "100%");
            this.stackType = c;
            var d = [], e = [], f = [], g = [], h, i = this.chart.graphs, j, k, l, m, n, o = this.baseValue, p = !1;
            if ("line" == b || "step" == b || "smoothedLine" == b) p = !0;
            if (p && ("regular" == c || "100%" == c)) for (m = 0; m < i.length; m++) l = i[m], 
            l.stackGraph = null, l.hidden || (k = l.type, l.chart == this.chart && l.valueAxis == this && b == k && l.stackable && (j && (l.stackGraph = j), 
            j = l));
            l = this.start - 10;
            j = this.end + 10;
            m = this.data.length - 1;
            l = a.fitToBounds(l, 0, m);
            j = a.fitToBounds(j, 0, m);
            for (n = l; n <= j; n++) {
                var q = 0;
                for (m = 0; m < i.length; m++) if (l = i[m], l.hidden) l.newStack && (f[n] = 0/0, 
                e[n] = 0/0); else if (k = l.type, l.chart == this.chart && l.valueAxis == this && b == k && l.stackable) if (k = this.data[n].axes[this.id].graphs[l.id], 
                h = k.values.value, isNaN(h)) l.newStack && (f[n] = 0/0, e[n] = 0/0); else {
                    var r = a.getDecimals(h);
                    q < r && (q = r);
                    isNaN(g[n]) ? g[n] = Math.abs(h) : g[n] += Math.abs(h);
                    g[n] = a.roundTo(g[n], q);
                    r = l.fillToGraph;
                    p && r && (r = this.data[n].axes[this.id].graphs[r.id]) && (k.values.open = r.values.value);
                    "regular" == c && (p && (isNaN(d[n]) ? (d[n] = h, k.values.close = h, k.values.open = this.baseValue) : (isNaN(h) ? k.values.close = d[n] : k.values.close = h + d[n], 
                    k.values.open = d[n], d[n] = k.values.close)), "column" == b && (l.newStack && (f[n] = 0/0, 
                    e[n] = 0/0), k.values.close = h, 0 > h ? (k.values.close = h, isNaN(e[n]) ? k.values.open = o : (k.values.close += e[n], 
                    k.values.open = e[n]), e[n] = k.values.close) : (k.values.close = h, isNaN(f[n]) ? k.values.open = o : (k.values.close += f[n], 
                    k.values.open = f[n]), f[n] = k.values.close)));
                }
            }
            for (n = this.start; n <= this.end; n++) for (m = 0; m < i.length; m++) (l = i[m], 
            l.hidden) ? l.newStack && (f[n] = 0/0, e[n] = 0/0) : (k = l.type, l.chart == this.chart && l.valueAxis == this && b == k && l.stackable && (k = this.data[n].axes[this.id].graphs[l.id], 
            h = k.values.value, isNaN(h) || (d = h / g[n] * 100, k.values.percents = d, k.values.total = g[n], 
            l.newStack && (f[n] = 0/0, e[n] = 0/0), "100%" == c && (isNaN(e[n]) && (e[n] = 0), 
            isNaN(f[n]) && (f[n] = 0), 0 > d ? (k.values.close = a.fitToBounds(d + e[n], -100, 100), 
            k.values.open = e[n], e[n] = k.values.close) : (k.values.close = a.fitToBounds(d + f[n], -100, 100), 
            k.values.open = f[n], f[n] = k.values.close)))));
        },
        recalculate: function() {
            var b = this.chart, c = b.graphs, d;
            for (d = 0; d < c.length; d++) {
                var e = c[d];
                if (e.valueAxis == this) {
                    var f = "value";
                    if ("candlestick" == e.type || "ohlc" == e.type) f = "open";
                    var g, h, i = this.end + 2, i = a.fitToBounds(this.end + 1, 0, this.data.length - 1), j = this.start;
                    0 < j && j--;
                    var k;
                    h = this.start;
                    e.compareFromStart && (h = 0);
                    if (!isNaN(b.startTime) && (k = b.categoryAxis)) {
                        var l = k.minDuration(), l = new Date(b.startTime + l / 2), m = a.resetDateToMin(new Date(b.startTime), k.minPeriod).getTime();
                        a.resetDateToMin(new Date(l), k.minPeriod).getTime() > m && h++;
                    }
                    if (k = b.recalculateFromDate) k = a.getDate(k, b.dataDateFormat, "fff"), h = b.getClosestIndex(b.chartData, "time", k.getTime(), !0, 0, b.chartData.length), 
                    i = b.chartData.length - 1;
                    for (k = h; k <= i && (h = this.data[k].axes[this.id].graphs[e.id], g = h.values[f], 
                    e.recalculateValue && (g = h.dataContext[e.valueField + e.recalculateValue]), isNaN(g)); k++) ;
                    this.recBaseValue = g;
                    for (f = j; f <= i; f++) {
                        h = this.data[f].axes[this.id].graphs[e.id];
                        h.percents = {};
                        var j = h.values, n;
                        for (n in j) h.percents[n] = "percents" != n ? j[n] / g * 100 - 100 : j[n];
                    }
                }
            }
        },
        getMinMax: function() {
            var b = !1, c = this.chart, d = c.graphs, e;
            for (e = 0; e < d.length; e++) {
                var f = d[e].type;
                ("line" == f || "step" == f || "smoothedLine" == f) && this.expandMinMax && (b = !0);
            }
            b && (0 < this.start && this.start--, this.end < this.data.length - 1 && this.end++);
            "serial" == c.type && (!0 !== c.categoryAxis.parseDates || b || this.end < this.data.length - 1 && this.end++);
            this.includeAllValues && (this.start = 0, this.end = this.data.length - 1);
            b = this.minMaxMultiplier;
            c = this.getExtremes(this.start, this.end);
            this.min = c.min;
            this.max = c.max;
            this.minRR = this.min;
            this.maxRR = this.max;
            b = (this.max - this.min) * (b - 1);
            this.min -= b;
            this.max += b;
            b = this.guides.length;
            if (this.includeGuidesInMinMax && 0 < b) for (c = 0; c < b; c++) d = this.guides[c], 
            d.toValue < this.min && (this.min = d.toValue), d.value < this.min && (this.min = d.value), 
            d.toValue > this.max && (this.max = d.toValue), d.value > this.max && (this.max = d.value);
            isNaN(this.minimum) || (this.min = this.minimum);
            isNaN(this.maximum) || (this.max = this.maximum);
            "date" == this.type && this.getDateMinMax();
            this.min > this.max && (b = this.max, this.max = this.min, this.min = b);
            isNaN(this.minZoom) || (this.min = this.minZoom);
            isNaN(this.maxZoom) || (this.max = this.maxZoom);
            this.minCalc = this.min;
            this.maxCalc = this.max;
            this.minReal = this.min;
            this.maxReal = this.max;
            0 === this.min && 0 === this.max && (this.max = 9);
            this.min > this.max && (this.min = this.max - 1);
            b = this.min;
            c = this.max;
            d = this.max - this.min;
            e = 0 === d ? Math.pow(10, Math.floor(Math.log(Math.abs(this.max)) * Math.LOG10E)) / 10 : Math.pow(10, Math.floor(Math.log(Math.abs(d)) * Math.LOG10E)) / 10;
            isNaN(this.maximum) && (this.max = Math.ceil(this.max / e) * e + e);
            isNaN(this.minimum) && (this.min = Math.floor(this.min / e) * e - e);
            0 > this.min && 0 <= b && (this.min = 0);
            0 < this.max && 0 >= c && (this.max = 0);
            "100%" == this.stackType && (this.min = 0 > this.min ? -100 : 0, this.max = 0 > this.max ? 0 : 100);
            d = this.max - this.min;
            e = Math.pow(10, Math.floor(Math.log(Math.abs(d)) * Math.LOG10E)) / 10;
            this.step = Math.ceil(d / this.gridCountR / e) * e;
            d = Math.pow(10, Math.floor(Math.log(Math.abs(this.step)) * Math.LOG10E));
            d = a.fixStepE(d);
            e = Math.ceil(this.step / d);
            5 < e && (e = 10);
            5 >= e && 2 < e && (e = 5);
            this.step = Math.ceil(this.step / (d * e)) * d * e;
            1 > d ? (this.maxDecCount = Math.abs(Math.log(Math.abs(d)) * Math.LOG10E), this.maxDecCount = Math.round(this.maxDecCount), 
            this.step = a.roundTo(this.step, this.maxDecCount + 1)) : this.maxDecCount = 0;
            this.min = this.step * Math.floor(this.min / this.step);
            this.max = this.step * Math.ceil(this.max / this.step);
            0 > this.min && 0 <= b && (this.min = 0);
            0 < this.max && 0 >= c && (this.max = 0);
            1 < this.minReal && 1 < this.max - this.minReal && (this.minReal = Math.floor(this.minReal));
            d = Math.pow(10, Math.floor(Math.log(Math.abs(this.minReal)) * Math.LOG10E));
            0 === this.min && (this.minReal = d);
            0 === this.min && 1 < this.minReal && (this.minReal = 1);
            0 < this.min && 0 < this.minReal - this.step && (this.minReal = this.min + this.step < this.minReal ? this.min + this.step : this.min);
            this.logarithmic && (2 < Math.log(c) * Math.LOG10E - Math.log(b) * Math.LOG10E ? (this.minReal = this.min = Math.pow(10, Math.floor(Math.log(Math.abs(b)) * Math.LOG10E)), 
            this.max = Math.pow(10, Math.ceil(Math.log(Math.abs(c)) * Math.LOG10E))) : (b = Math.pow(10, Math.floor(Math.log(Math.abs(b)) * Math.LOG10E)) / 10, 
            Math.pow(10, Math.floor(Math.log(Math.abs(this.min)) * Math.LOG10E)) / 10 < b && (this.minReal = this.min = 10 * b)));
        },
        getExtremes: function(a, b) {
            var c, d, e;
            for (e = a; e <= b; e++) {
                var f = this.data[e].axes[this.id].graphs, g;
                for (g in f) if (f.hasOwnProperty(g)) {
                    var h = this.chart.graphsById[g];
                    if (h.includeInMinMax && (!h.hidden || this.includeHidden)) {
                        isNaN(c) && (c = 1/0);
                        isNaN(d) && (d = -1/0);
                        this.foundGraphs = !0;
                        h = f[g].values;
                        this.recalculateToPercents && (h = f[g].percents);
                        var i;
                        if (this.minMaxField) i = h[this.minMaxField], i < c && (c = i), i > d && (d = i); else for (var j in h) h.hasOwnProperty(j) && "percents" != j && "total" != j && (i = h[j], 
                        i < c && (c = i), i > d && (d = i));
                    }
                }
            }
            return {
                min: c,
                max: d
            };
        },
        zoomOut: function() {
            this.maxZoom = this.minZoom = 0/0;
            this.zoomToRelativeValues(0, 1);
        },
        zoomToRelativeValues: function(a, b, c) {
            if (this.reversed) {
                var d = a;
                a = 1 - b;
                b = 1 - d;
            }
            var e = this.fullMax, d = this.fullMin, f = d + (e - d) * a, g = d + (e - d) * b;
            this.logarithmic && (e = Math.log(e) * Math.LOG10E - Math.log(d) * Math.LOG10E, 
            f = Math.pow(10, e * a + Math.log(d) * Math.LOG10E), g = Math.pow(10, e * b + Math.log(d) * Math.LOG10E));
            return this.zoomToValues(f, g, c);
        },
        zoomToValues: function(b, c, d) {
            if (c < b) {
                var e = c;
                c = b;
                b = e;
            }
            var f = this.fullMax, e = this.fullMin;
            this.relativeStart = (b - e) / (f - e);
            this.relativeEnd = (c - e) / (f - e);
            if (this.logarithmic) {
                var f = Math.log(f) * Math.LOG10E - Math.log(e) * Math.LOG10E, g = Math.log(c) / Math.LN10 - Math.log(e) * Math.LOG10E;
                this.relativeStart = (Math.log(b) / Math.LN10 - Math.log(e) * Math.LOG10E) / f;
                this.relativeEnd = g / f;
            }
            if (this.minZoom != b || this.maxZoom != c) {
                if (0 !== this.relativeStart || 1 != this.relativeEnd) this.minZoom = b, this.maxZoom = c;
                e = {
                    type: "axisZoomed"
                };
                e.chart = this.chart;
                e.valueAxis = this;
                e.startValue = b;
                e.endValue = c;
                e.relativeStart = this.relativeStart;
                e.relativeEnd = this.relativeEnd;
                this.prevStartValue == b && this.prevEndValue == c || this.fire(e);
                this.prevStartValue = b;
                this.prevEndValue = c;
                d || (b = {}, a.copyProperties(e, b), b.type = "axisIntZoomed", this.fire(b));
                return !0;
            }
        },
        coordinateToValue: function(a) {
            if (isNaN(a)) return 0/0;
            var b = this.axisWidth, c = this.stepWidth, d = this.reversed, e = this.rotate, f = this.min, g = this.minReal;
            return !0 === this.logarithmic ? Math.pow(10, (e ? !0 === d ? (b - a) / c : a / c : !0 === d ? a / c : (b - a) / c) + Math.log(g) * Math.LOG10E) : !0 === d ? e ? f - (a - b) / c : a / c + f : e ? a / c + f : f - (a - b) / c;
        },
        getCoordinate: function(a, b) {
            if (isNaN(a)) return 0/0;
            var c = this.rotate, d = this.reversed, e = this.axisWidth, f = this.stepWidth, g = this.min, h = this.minReal;
            !0 === this.logarithmic ? (0 === a && (a = this.treatZeroAs), g = Math.log(a) * Math.LOG10E - Math.log(h) * Math.LOG10E, 
            c = c ? !0 === d ? e - f * g : f * g : !0 === d ? f * g : e - f * g) : c = !0 === d ? c ? e - f * (a - g) : f * (a - g) : c ? f * (a - g) : e - f * (a - g);
            1e7 < Math.abs(c) && (c = c / Math.abs(c) * 1e7);
            b || (c = Math.round(c));
            return c;
        },
        synchronizeWithAxis: function(a) {
            this.synchronizeWith = a;
            this.listenTo(this.synchronizeWith, "axisChanged", this.handleSynchronization);
        },
        handleSynchronization: function() {
            if (this.synchronizeWith) {
                a.isString(this.synchronizeWith) && (this.synchronizeWith = this.chart.getValueAxisById(this.synchronizeWith));
                var b = this.synchronizeWith, c = b.min, d = b.max, b = b.step, e = this.synchronizationMultiplier;
                e && (this.min = c * e, this.max = d * e, this.step = b * e, c = Math.abs(Math.log(Math.abs(Math.pow(10, Math.floor(Math.log(Math.abs(this.step)) * Math.LOG10E)))) * Math.LOG10E), 
                this.maxDecCount = c = Math.round(c), this.draw());
            }
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.RecAxis = a.Class({
        construct: function(b) {
            var c = b.chart, d = b.axisThickness, e = b.axisColor, f = b.axisAlpha, g = b.offset, h = b.dx, i = b.dy, j = b.x, k = b.y, l = b.height, m = b.width, n = c.container;
            "H" == b.orientation ? (e = a.line(n, [ 0, m ], [ 0, 0 ], e, f, d), this.axisWidth = b.width, 
            "bottom" == b.position ? (i = d / 2 + g + l + k - 1, d = j) : (i = -d / 2 - g + k + i, 
            d = h + j)) : (this.axisWidth = b.height, "right" == b.position ? (e = a.line(n, [ 0, 0, -h ], [ 0, l, l - i ], e, f, d), 
            i = k + i, d = d / 2 + g + h + m + j - 1) : (e = a.line(n, [ 0, 0 ], [ 0, l ], e, f, d), 
            i = k, d = -d / 2 - g + j));
            e.translate(d, i);
            d = c.container.set();
            d.push(e);
            c.axesSet.push(d);
            a.setCN(c, e, b.bcn + "line");
            this.axisSet = d;
            this.set = e;
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.RecItem = a.Class({
        construct: function(b, c, d, e, f, g, h, i, j, k, l, m) {
            c = Math.round(c);
            var n = b.chart;
            this.value = d;
            void 0 == d && (d = "");
            j || (j = 0);
            void 0 == e && (e = !0);
            var o = n.fontFamily, p = b.fontSize;
            void 0 == p && (p = n.fontSize);
            var q = b.color;
            void 0 == q && (q = n.color);
            void 0 !== l && (q = l);
            var r = b.chart.container, s = r.set();
            this.set = s;
            var t = b.axisThickness, u = b.axisColor, v = b.axisAlpha, w = b.tickLength, x = b.gridAlpha, y = b.gridThickness, z = b.gridColor, A = b.dashLength, B = b.fillColor, C = b.fillAlpha, D = b.labelsEnabled;
            l = b.labelRotationR;
            var E = b.counter, F = b.inside, G = b.labelOffset, H = b.dx, I = b.dy, J = b.orientation, K = b.position, L = b.previousCoord, M = b.height, N = b.width, O = b.offset, P, Q;
            h ? (void 0 !== h.id && (m = n.classNamePrefix + "-guide-" + h.id), D = !0, isNaN(h.tickLength) || (w = h.tickLength), 
            void 0 != h.lineColor && (z = h.lineColor), void 0 != h.color && (q = h.color), 
            isNaN(h.lineAlpha) || (x = h.lineAlpha), isNaN(h.dashLength) || (A = h.dashLength), 
            isNaN(h.lineThickness) || (y = h.lineThickness), !0 === h.inside && (F = !0, 0 < O && (O = 0)), 
            isNaN(h.labelRotation) || (l = h.labelRotation), isNaN(h.fontSize) || (p = h.fontSize), 
            h.position && (K = h.position), void 0 !== h.boldLabel && (i = h.boldLabel), isNaN(h.labelOffset) || (G = h.labelOffset)) : "" === d && (w = 0);
            k && !isNaN(b.minorTickLength) && (w = b.minorTickLength);
            var R = "start";
            0 < f && (R = "middle");
            b.centerLabels && (R = "middle");
            var S = l * Math.PI / 180, T, U, V = 0, W = 0, X = 0, Y = T = 0, Z = 0;
            "V" == J && (l = 0);
            var $;
            D && "" !== d && ($ = b.autoWrap && 0 === l ? a.wrappedText(r, d, q, o, p, R, i, Math.abs(f), 0) : a.text(r, d, q, o, p, R, i), 
            R = $.getBBox(), Y = R.width, Z = R.height);
            if ("H" == J) {
                if (0 <= c && c <= N + 1 && (0 < w && 0 < v && c + j <= N + 1 && (P = a.line(r, [ c + j, c + j ], [ 0, w ], u, v, y), 
                s.push(P)), 0 < x && (Q = a.line(r, [ c, c + H, c + H ], [ M, M + I, I ], z, x, y, A), 
                s.push(Q))), W = 0, V = c, h && 90 == l && F && (V -= p), !1 === e ? (R = "start", 
                W = "bottom" == K ? F ? W + w : W - w : F ? W - w : W + w, V += 3, 0 < f && (V += f / 2 - 3, 
                R = "middle"), 0 < l && (R = "middle")) : R = "middle", 1 == E && 0 < C && !h && !k && L < N && (e = a.fitToBounds(c, 0, N), 
                L = a.fitToBounds(L, 0, N), T = e - L, 0 < T && (U = a.rect(r, T, b.height, B, C), 
                U.translate(e - T + H, I), s.push(U))), "bottom" == K ? (W += M + p / 2 + O, F ? (0 < l ? (W = M - Y / 2 * Math.sin(S) - w - 3, 
                V += Y / 2 * Math.cos(S) - 4 + 2) : 0 > l ? (W = M + Y * Math.sin(S) - w - 3 + 2, 
                V += -Y * Math.cos(S) - Z * Math.sin(S) - 4) : W -= w + p + 3 + 3, W -= G) : (0 < l ? (W = M + Y / 2 * Math.sin(S) + w + 3, 
                V -= Y / 2 * Math.cos(S)) : 0 > l ? (W = M + w + 3 - Y / 2 * Math.sin(S) + 2, V += Y / 2 * Math.cos(S)) : W += w + t + 3 + 3, 
                W += G)) : (W += I + p / 2 - O, V += H, F ? (0 < l ? (W = Y / 2 * Math.sin(S) + w + 3, 
                V -= Y / 2 * Math.cos(S)) : W += w + 3, W += G) : (0 < l ? (W = -(Y / 2) * Math.sin(S) - w - 6, 
                V += Y / 2 * Math.cos(S)) : W -= w + p + 3 + t + 3, W -= G)), "bottom" == K ? T = (F ? M - w - 1 : M + t - 1) + O : (X = H, 
                T = (F ? I : I - w - t + 1) - O), g && (V += g), g = V, 0 < l && (g += Y / 2 * Math.cos(S)), 
                $ && (p = 0, F && (p = Y / 2 * Math.cos(S)), g + p > N + 2 || 0 > g)) $.remove(), 
                $ = null;
            } else {
                0 <= c && c <= M + 1 && (0 < w && 0 < v && c + j <= M + 1 && (P = a.line(r, [ 0, w + 1 ], [ c + j, c + j ], u, v, y), 
                s.push(P)), 0 < x && (Q = a.line(r, [ 0, H, N + H ], [ c, c + I, c + I ], z, x, y, A), 
                s.push(Q)));
                R = "end";
                if (!0 === F && "left" == K || !1 === F && "right" == K) R = "start";
                W = c - Z / 2 + 2;
                1 == E && 0 < C && !h && !k && (e = a.fitToBounds(c, 0, M), L = a.fitToBounds(L, 0, M), 
                S = e - L, U = a.polygon(r, [ 0, b.width, b.width, 0 ], [ 0, 0, S, S ], B, C), U.translate(H, e - S + I), 
                s.push(U));
                W += p / 2;
                "right" == K ? (V += H + N + O, W += I, F ? (g || (W -= p / 2 + 3), V = V - (w + 4) - G) : (V += w + 4 + t, 
                W -= 2, V += G)) : F ? (V += w + 4 - O, g || (W -= p / 2 + 3), h && (V += H, W += I), 
                V += G) : (V += -w - t - 4 - 2 - O, W -= 2, V -= G);
                P && ("right" == K ? (X += H + O + N - 1, T += I, X = F ? X - t : X + t) : (X -= O, 
                F || (X -= w + t)));
                g && (W += g);
                F = -3;
                "right" == K && (F += I);
                $ && (W > M + 1 || W < F) && ($.remove(), $ = null);
            }
            P && (P.translate(X, T), a.setCN(n, P, b.bcn + "tick"), a.setCN(n, P, m, !0), h && a.setCN(n, P, "guide"));
            !1 === b.visible && (P && P.remove(), $ && ($.remove(), $ = null));
            $ && ($.attr({
                "text-anchor": R
            }), $.translate(V, W, 0/0, !0), 0 !== l && $.rotate(-l, b.chart.backgroundColor), 
            b.allLabels.push($), this.label = $, a.setCN(n, $, b.bcn + "label"), a.setCN(n, $, m, !0), 
            h && a.setCN(n, $, "guide"));
            Q && (a.setCN(n, Q, b.bcn + "grid"), a.setCN(n, Q, m, !0), h && a.setCN(n, Q, "guide"));
            U && (a.setCN(n, U, b.bcn + "fill"), a.setCN(n, U, m, !0));
            k ? Q && a.setCN(n, Q, b.bcn + "grid-minor") : (b.counter = 0 === E ? 1 : 0, b.previousCoord = c);
            0 === this.set.node.childNodes.length && this.set.remove();
        },
        graphics: function() {
            return this.set;
        },
        getLabel: function() {
            return this.label;
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.RecFill = a.Class({
        construct: function(b, c, d, e) {
            var f = b.dx, g = b.dy, h = b.orientation, i = 0;
            if (d < c) {
                var j = c;
                c = d;
                d = j;
            }
            var k = e.fillAlpha;
            isNaN(k) && (k = 0);
            var j = b.chart.container, l = e.fillColor;
            "V" == h ? (c = a.fitToBounds(c, 0, b.height), d = a.fitToBounds(d, 0, b.height)) : (c = a.fitToBounds(c, 0, b.width), 
            d = a.fitToBounds(d, 0, b.width));
            d -= c;
            isNaN(d) && (d = 4, i = 2, k = 0);
            0 > d && "object" == typeof l && (l = l.join(",").split(",").reverse());
            "V" == h ? (h = a.rect(j, b.width, d, l, k), h.translate(f, c - i + g)) : (h = a.rect(j, d, b.height, l, k), 
            h.translate(c - i + f, g));
            a.setCN(b.chart, h, "guide-fill");
            e.id && a.setCN(b.chart, h, "guide-fill-" + e.id);
            this.set = j.set([ h ]);
        },
        graphics: function() {
            return this.set;
        },
        getLabel: function() {}
    });
}();

!function() {
    var a = window.AmCharts;
    a.AmChart = a.Class({
        construct: function(b) {
            this.svgIcons = this.tapToActivate = !0;
            this.theme = b;
            this.classNamePrefix = "amcharts";
            this.addClassNames = !1;
            this.version = "3.19.6";
            a.addChart(this);
            this.createEvents("buildStarted", "dataUpdated", "init", "rendered", "drawn", "failed", "resized", "animationFinished");
            this.height = this.width = "100%";
            this.dataChanged = !0;
            this.chartCreated = !1;
            this.previousWidth = this.previousHeight = 0;
            this.backgroundColor = "#FFFFFF";
            this.borderAlpha = this.backgroundAlpha = 0;
            this.color = this.borderColor = "#000000";
            this.fontFamily = "Verdana";
            this.fontSize = 11;
            this.usePrefixes = !1;
            this.autoResize = !0;
            this.autoDisplay = !1;
            this.addCodeCredits = !0;
            this.touchStartTime = this.touchClickDuration = 0;
            this.precision = -1;
            this.percentPrecision = 2;
            this.decimalSeparator = ".";
            this.thousandsSeparator = ",";
            this.labels = [];
            this.allLabels = [];
            this.titles = [];
            this.marginRight = this.marginLeft = this.autoMarginOffset = 0;
            this.timeOuts = [];
            this.creditsPosition = "top-left";
            var c = document.createElement("div"), d = c.style;
            d.overflow = "hidden";
            d.position = "relative";
            d.textAlign = "left";
            this.chartDiv = c;
            c = document.createElement("div");
            d = c.style;
            d.overflow = "hidden";
            d.position = "relative";
            d.textAlign = "left";
            this.legendDiv = c;
            this.titleHeight = 0;
            this.hideBalloonTime = 150;
            this.handDrawScatter = 2;
            this.handDrawThickness = 1;
            this.prefixesOfBigNumbers = [ {
                number: 1e3,
                prefix: "k"
            }, {
                number: 1e6,
                prefix: "M"
            }, {
                number: 1e9,
                prefix: "G"
            }, {
                number: 1e12,
                prefix: "T"
            }, {
                number: 1e15,
                prefix: "P"
            }, {
                number: 1e18,
                prefix: "E"
            }, {
                number: 1e21,
                prefix: "Z"
            }, {
                number: 1e24,
                prefix: "Y"
            } ];
            this.prefixesOfSmallNumbers = [ {
                number: 1e-24,
                prefix: "y"
            }, {
                number: 1e-21,
                prefix: "z"
            }, {
                number: 1e-18,
                prefix: "a"
            }, {
                number: 1e-15,
                prefix: "f"
            }, {
                number: 1e-12,
                prefix: "p"
            }, {
                number: 1e-9,
                prefix: "n"
            }, {
                number: 1e-6,
                prefix: "μ"
            }, {
                number: .001,
                prefix: "m"
            } ];
            this.panEventsEnabled = !0;
            this.product = "amcharts";
            this.animations = [];
            this.balloon = new a.AmBalloon(this.theme);
            this.balloon.chart = this;
            this.processTimeout = 0;
            this.processCount = 1e3;
            this.animatable = [];
            a.applyTheme(this, b, "AmChart");
        },
        drawChart: function() {
            0 < this.realWidth && 0 < this.realHeight && (this.drawBackground(), this.redrawLabels(), 
            this.drawTitles(), this.brr(), this.renderFix(), this.chartDiv && (this.boundingRect = this.chartDiv.getBoundingClientRect()));
        },
        drawBackground: function() {
            a.remove(this.background);
            var b = this.container, c = this.backgroundColor, d = this.backgroundAlpha, e = this.set;
            a.isModern || 0 !== d || (d = .001);
            var f = this.updateWidth();
            this.realWidth = f;
            var g = this.updateHeight();
            this.realHeight = g;
            c = a.polygon(b, [ 0, f - 1, f - 1, 0 ], [ 0, 0, g - 1, g - 1 ], c, d, 1, this.borderColor, this.borderAlpha);
            a.setCN(this, c, "bg");
            this.background = c;
            e.push(c);
            if (c = this.backgroundImage) b = b.image(c, 0, 0, f, g), a.setCN(this, c, "bg-image"), 
            this.bgImg = b, e.push(b);
        },
        drawTitles: function(b) {
            var c = this.titles;
            this.titleHeight = 0;
            if (a.ifArray(c)) {
                var d = 20, e;
                for (e = 0; e < c.length; e++) {
                    var f = c[e], f = a.processObject(f, a.Title, this.theme);
                    if (!1 !== f.enabled) {
                        var g = f.color;
                        void 0 === g && (g = this.color);
                        var h = f.size;
                        isNaN(h) && (h = this.fontSize + 2);
                        isNaN(f.alpha);
                        var i = this.marginLeft, j = !0;
                        void 0 !== f.bold && (j = f.bold);
                        g = a.wrappedText(this.container, f.text, g, this.fontFamily, h, "middle", j, this.realWidth - 35);
                        g.translate(i + (this.realWidth - this.marginRight - i) / 2, d);
                        g.node.style.pointerEvents = "none";
                        f.sprite = g;
                        a.setCN(this, g, "title");
                        f.id && a.setCN(this, g, "title-" + f.id);
                        g.attr({
                            opacity: f.alpha
                        });
                        d += g.getBBox().height + 5;
                        b ? g.remove() : this.freeLabelsSet.push(g);
                    }
                }
                this.titleHeight = d - 10;
            }
        },
        write: function(a) {
            var b = this;
            if (b.listeners) for (var c = 0; c < b.listeners.length; c++) {
                var d = b.listeners[c];
                b.addListener(d.event, d.method);
            }
            b.fire({
                type: "buildStarted",
                chart: b
            });
            b.afterWriteTO && clearTimeout(b.afterWriteTO);
            0 < b.processTimeout ? b.afterWriteTO = setTimeout(function() {
                b.afterWrite.call(b, a);
            }, b.processTimeout) : b.afterWrite(a);
        },
        afterWrite: function(b) {
            if (b = "object" != typeof b ? document.getElementById(b) : b) {
                for (;b.firstChild; ) b.removeChild(b.firstChild);
                this.div = b;
                b.style.overflow = "hidden";
                b.style.textAlign = "left";
                var c = this.chartDiv, d = this.legendDiv, e = this.legend, f = d.style, g = c.style;
                this.measure();
                this.previousHeight = this.divRealHeight;
                this.previousWidth = this.divRealWidth;
                var h, i = document.createElement("div");
                h = i.style;
                h.position = "relative";
                this.containerDiv = i;
                i.className = this.classNamePrefix + "-main-div";
                c.className = this.classNamePrefix + "-chart-div";
                b.appendChild(i);
                var j = this.exportConfig;
                j && a.AmExport && !this.AmExport && (this.AmExport = new a.AmExport(this, j));
                this.amExport && a.AmExport && (this.AmExport = a.extend(this.amExport, new a.AmExport(this), !0));
                this.AmExport && this.AmExport.init && this.AmExport.init();
                if (e) {
                    e = this.addLegend(e, e.divId);
                    if (e.enabled) switch (f.left = null, f.top = null, f.right = null, g.left = null, 
                    g.right = null, g.top = null, f.position = "relative", g.position = "relative", 
                    e.position) {
                      case "bottom":
                        i.appendChild(c);
                        i.appendChild(d);
                        break;

                      case "top":
                        i.appendChild(d);
                        i.appendChild(c);
                        break;

                      case "absolute":
                        h.width = b.style.width;
                        h.height = b.style.height;
                        f.position = "absolute";
                        g.position = "absolute";
                        void 0 !== e.left && (f.left = e.left + "px");
                        void 0 !== e.right && (f.right = e.right + "px");
                        void 0 !== e.top && (f.top = e.top + "px");
                        void 0 !== e.bottom && (f.bottom = e.bottom + "px");
                        e.marginLeft = 0;
                        e.marginRight = 0;
                        i.appendChild(c);
                        i.appendChild(d);
                        break;

                      case "right":
                        h.width = b.style.width;
                        h.height = b.style.height;
                        f.position = "relative";
                        g.position = "absolute";
                        i.appendChild(c);
                        i.appendChild(d);
                        break;

                      case "left":
                        h.width = b.style.width;
                        h.height = b.style.height;
                        f.position = "absolute";
                        g.position = "relative";
                        i.appendChild(c);
                        i.appendChild(d);
                        break;

                      case "outside":
                        i.appendChild(c);
                    } else i.appendChild(c);
                    this.prevLegendPosition = e.position;
                } else i.appendChild(c);
                this.listenersAdded || (this.addListeners(), this.listenersAdded = !0);
                this.initChart();
            }
        },
        createLabelsSet: function() {
            a.remove(this.labelsSet);
            this.labelsSet = this.container.set();
            this.freeLabelsSet.push(this.labelsSet);
        },
        initChart: function() {
            this.balloon = a.processObject(this.balloon, a.AmBalloon, this.theme);
            window.AmCharts_path && (this.path = window.AmCharts_path);
            void 0 === this.path && (this.path = a.getPath());
            void 0 === this.path && (this.path = "amcharts/");
            this.path = a.normalizeUrl(this.path);
            void 0 === this.pathToImages && (this.pathToImages = this.path + "images/");
            this.initHC || (a.callInitHandler(this), this.initHC = !0);
            a.applyLang(this.language, this);
            var b = this.numberFormatter;
            b && (isNaN(b.precision) || (this.precision = b.precision), void 0 !== b.thousandsSeparator && (this.thousandsSeparator = b.thousandsSeparator), 
            void 0 !== b.decimalSeparator && (this.decimalSeparator = b.decimalSeparator));
            (b = this.percentFormatter) && !isNaN(b.precision) && (this.percentPrecision = b.precision);
            this.nf = {
                precision: this.precision,
                thousandsSeparator: this.thousandsSeparator,
                decimalSeparator: this.decimalSeparator
            };
            this.pf = {
                precision: this.percentPrecision,
                thousandsSeparator: this.thousandsSeparator,
                decimalSeparator: this.decimalSeparator
            };
            this.destroy();
            (b = this.container) ? (b.container.innerHTML = "", b.width = this.realWidth, b.height = this.realHeight, 
            b.addDefs(this), this.chartDiv.appendChild(b.container)) : b = new a.AmDraw(this.chartDiv, this.realWidth, this.realHeight, this);
            this.container = b;
            this.extension = ".png";
            this.svgIcons && a.SVG && (this.extension = ".svg");
            this.checkDisplay();
            b.chart = this;
            a.VML || a.SVG ? (b.handDrawn = this.handDrawn, b.handDrawScatter = this.handDrawScatter, 
            b.handDrawThickness = this.handDrawThickness, a.remove(this.set), this.set = b.set(), 
            a.remove(this.gridSet), this.gridSet = b.set(), a.remove(this.cursorLineSet), this.cursorLineSet = b.set(), 
            a.remove(this.graphsBehindSet), this.graphsBehindSet = b.set(), a.remove(this.bulletBehindSet), 
            this.bulletBehindSet = b.set(), a.remove(this.columnSet), this.columnSet = b.set(), 
            a.remove(this.graphsSet), this.graphsSet = b.set(), a.remove(this.trendLinesSet), 
            this.trendLinesSet = b.set(), a.remove(this.axesSet), this.axesSet = b.set(), a.remove(this.cursorSet), 
            this.cursorSet = b.set(), a.remove(this.scrollbarsSet), this.scrollbarsSet = b.set(), 
            a.remove(this.bulletSet), this.bulletSet = b.set(), a.remove(this.freeLabelsSet), 
            this.freeLabelsSet = b.set(), a.remove(this.axesLabelsSet), this.axesLabelsSet = b.set(), 
            a.remove(this.balloonsSet), this.balloonsSet = b.set(), a.remove(this.plotBalloonsSet), 
            this.plotBalloonsSet = b.set(), a.remove(this.zoomButtonSet), this.zoomButtonSet = b.set(), 
            a.remove(this.zbSet), this.zbSet = null, a.remove(this.linkSet), this.linkSet = b.set()) : this.fire({
                type: "failed",
                chart: this
            });
        },
        premeasure: function() {
            var a = this.div;
            if (a) {
                try {
                    this.boundingRect = this.chartDiv.getBoundingClientRect();
                } catch (b) {}
                var c = a.offsetWidth, d = a.offsetHeight;
                a.clientHeight && (c = a.clientWidth, d = a.clientHeight);
                if (c != this.mw || d != this.mh) this.mw = c, this.mh = d, this.measure();
            }
        },
        measure: function() {
            var b = this.div;
            if (b) {
                var c = this.chartDiv, d = b.offsetWidth, e = b.offsetHeight, f = this.container;
                b.clientHeight && (d = b.clientWidth, e = b.clientHeight);
                var g = a.removePx(a.getStyle(b, "padding-left")), h = a.removePx(a.getStyle(b, "padding-right")), i = a.removePx(a.getStyle(b, "padding-top")), j = a.removePx(a.getStyle(b, "padding-bottom"));
                isNaN(g) || (d -= g);
                isNaN(h) || (d -= h);
                isNaN(i) || (e -= i);
                isNaN(j) || (e -= j);
                g = b.style;
                b = g.width;
                g = g.height;
                -1 != b.indexOf("px") && (d = a.removePx(b));
                -1 != g.indexOf("px") && (e = a.removePx(g));
                e = Math.round(e);
                d = Math.round(d);
                b = Math.round(a.toCoordinate(this.width, d));
                g = Math.round(a.toCoordinate(this.height, e));
                (d != this.previousWidth || e != this.previousHeight) && 0 < b && 0 < g && (c.style.width = b + "px", 
                c.style.height = g + "px", c.style.padding = 0, f && f.setSize(b, g), this.balloon = a.processObject(this.balloon, a.AmBalloon, this.theme));
                this.balloon.setBounds && this.balloon.setBounds(2, 2, b - 2, g);
                this.balloon.chart = this;
                this.realWidth = b;
                this.realHeight = g;
                this.divRealWidth = d;
                this.divRealHeight = e;
            }
        },
        checkDisplay: function() {
            if (this.autoDisplay && this.container) {
                var b = a.rect(this.container, 10, 10), c = b.getBBox();
                0 === c.width && 0 === c.height && (this.divRealHeight = this.divRealWidth = this.realHeight = this.realWidth = 0, 
                this.previousWidth = this.previousHeight = 0/0);
                b.remove();
            }
        },
        destroy: function() {
            this.chartDiv.innerHTML = "";
            this.clearTimeOuts();
            this.legend && this.legend.destroy();
        },
        clearTimeOuts: function() {
            var a = this.timeOuts;
            if (a) {
                var b;
                for (b = 0; b < a.length; b++) clearTimeout(a[b]);
            }
            this.timeOuts = [];
        },
        clear: function(b) {
            a.callMethod("clear", [ this.chartScrollbar, this.scrollbarV, this.scrollbarH, this.chartCursor ]);
            this.chartCursor = this.scrollbarH = this.scrollbarV = this.chartScrollbar = null;
            this.clearTimeOuts();
            this.container && (this.container.remove(this.chartDiv), this.container.remove(this.legendDiv));
            b || a.removeChart(this);
            if (b = this.div) for (;b.firstChild; ) b.removeChild(b.firstChild);
            this.legend && this.legend.destroy();
        },
        setMouseCursor: function(b) {
            "auto" == b && a.isNN && (b = "default");
            this.chartDiv.style.cursor = b;
            this.legendDiv.style.cursor = b;
        },
        redrawLabels: function() {
            this.labels = [];
            var a = this.allLabels;
            this.createLabelsSet();
            var b;
            for (b = 0; b < a.length; b++) this.drawLabel(a[b]);
        },
        drawLabel: function(b) {
            var c = this;
            if (c.container && !1 !== b.enabled) {
                b = a.processObject(b, a.Label, c.theme);
                var d = b.y, e = b.text, f = b.align, g = b.size, h = b.color, i = b.rotation, j = b.alpha, k = b.bold, l = a.toCoordinate(b.x, c.realWidth), d = a.toCoordinate(d, c.realHeight);
                l || (l = 0);
                d || (d = 0);
                void 0 === h && (h = c.color);
                isNaN(g) && (g = c.fontSize);
                f || (f = "start");
                "left" == f && (f = "start");
                "right" == f && (f = "end");
                "center" == f && (f = "middle", i ? d = c.realHeight - d + d / 2 : l = c.realWidth / 2 - l);
                void 0 === j && (j = 1);
                void 0 === i && (i = 0);
                d += g / 2;
                e = a.text(c.container, e, h, c.fontFamily, g, f, k, j);
                e.translate(l, d);
                a.setCN(c, e, "label");
                b.id && a.setCN(c, e, "label-" + b.id);
                0 !== i && e.rotate(i);
                b.url ? (e.setAttr("cursor", "pointer"), e.click(function() {
                    a.getURL(b.url, c.urlTarget);
                })) : e.node.style.pointerEvents = "none";
                c.labelsSet.push(e);
                c.labels.push(e);
            }
        },
        addLabel: function(a, b, c, d, e, f, g, h, i, j) {
            a = {
                x: a,
                y: b,
                text: c,
                align: d,
                size: e,
                color: f,
                alpha: h,
                rotation: g,
                bold: i,
                url: j,
                enabled: !0
            };
            this.container && this.drawLabel(a);
            this.allLabels.push(a);
        },
        clearLabels: function() {
            var a = this.labels, b;
            for (b = a.length - 1; 0 <= b; b--) a[b].remove();
            this.labels = [];
            this.allLabels = [];
        },
        updateHeight: function() {
            var a = this.divRealHeight, b = this.legend;
            if (b) {
                var c = this.legendDiv.offsetHeight, b = b.position;
                if ("top" == b || "bottom" == b) {
                    a -= c;
                    if (0 > a || isNaN(a)) a = 0;
                    this.chartDiv.style.height = a + "px";
                }
            }
            return a;
        },
        updateWidth: function() {
            var a = this.divRealWidth, b = this.divRealHeight, c = this.legend;
            if (c) {
                var d = this.legendDiv, e = d.offsetWidth;
                isNaN(c.width) || (e = c.width);
                c.ieW && (e = c.ieW);
                var f = d.offsetHeight, d = d.style, g = this.chartDiv.style, c = c.position;
                if ("right" == c || "left" == c) {
                    a -= e;
                    if (0 > a || isNaN(a)) a = 0;
                    g.width = a + "px";
                    this.balloon.setBounds(2, 2, a - 2, this.realHeight);
                    "left" == c ? (g.left = e + "px", d.left = "0px") : (g.left = "0px", d.left = a + "px");
                    b > f && (d.top = (b - f) / 2 + "px");
                }
            }
            return a;
        },
        getTitleHeight: function() {
            this.drawTitles(!0);
            return this.titleHeight;
        },
        addTitle: function(a, b, c, d, e) {
            isNaN(b) && (b = this.fontSize + 2);
            a = {
                text: a,
                size: b,
                color: c,
                alpha: d,
                bold: e,
                enabled: !0
            };
            this.titles.push(a);
            return a;
        },
        handleWheel: function(a) {
            var b = 0;
            a || (a = window.event);
            a.wheelDelta ? b = a.wheelDelta / 120 : a.detail && (b = -a.detail / 3);
            b && this.handleWheelReal(b, a.shiftKey);
            a.preventDefault && a.preventDefault();
        },
        handleWheelReal: function() {},
        handleDocTouchStart: function() {
            this.hideBalloonReal();
            this.handleMouseMove();
            this.tmx = this.mouseX;
            this.tmy = this.mouseY;
            this.touchStartTime = new Date().getTime();
        },
        handleDocTouchEnd: function() {
            -.5 < this.tmx && this.tmx < this.divRealWidth + 1 && 0 < this.tmy && this.tmy < this.divRealHeight ? (this.handleMouseMove(), 
            4 > Math.abs(this.mouseX - this.tmx) && 4 > Math.abs(this.mouseY - this.tmy) ? (this.tapped = !0, 
            this.panRequired && this.panEventsEnabled && this.chartDiv && (this.chartDiv.style.msTouchAction = "none", 
            this.chartDiv.style.touchAction = "none")) : this.mouseIsOver || this.resetTouchStyle()) : (this.tapped = !1, 
            this.resetTouchStyle());
        },
        resetTouchStyle: function() {
            this.panEventsEnabled && this.chartDiv && (this.chartDiv.style.msTouchAction = "auto", 
            this.chartDiv.style.touchAction = "auto");
        },
        checkTouchDuration: function() {
            if (new Date().getTime() - this.touchStartTime > this.touchClickDuration) return !0;
        },
        checkTouchMoved: function() {
            if (4 < Math.abs(this.mouseX - this.tmx) || 4 < Math.abs(this.mouseY - this.tmy)) return !0;
        },
        addListeners: function() {
            var a = this, b = a.chartDiv;
            document.addEventListener ? ("ontouchstart" in document.documentElement && (b.addEventListener("touchstart", function(b) {
                a.handleTouchStart.call(a, b);
            }, !0), b.addEventListener("touchmove", function(b) {
                a.handleMouseMove.call(a, b);
            }, !0), b.addEventListener("touchend", function(b) {
                a.handleTouchEnd.call(a, b);
            }, !0), document.addEventListener("touchstart", function(b) {
                a.handleDocTouchStart.call(a, b);
            }), document.addEventListener("touchend", function(b) {
                a.handleDocTouchEnd.call(a, b);
            })), b.addEventListener("mousedown", function(b) {
                a.mouseIsOver = !0;
                a.handleMouseMove.call(a, b);
                a.handleMouseDown.call(a, b);
                a.handleDocTouchStart.call(a, b);
            }, !0), b.addEventListener("mouseover", function(b) {
                a.handleMouseOver.call(a, b);
            }, !0), b.addEventListener("mouseout", function(b) {
                a.handleMouseOut.call(a, b);
            }, !0), b.addEventListener("mouseup", function(b) {
                a.handleDocTouchEnd.call(a, b);
            }, !0)) : (b.attachEvent("onmousedown", function(b) {
                a.handleMouseDown.call(a, b);
            }), b.attachEvent("onmouseover", function(b) {
                a.handleMouseOver.call(a, b);
            }), b.attachEvent("onmouseout", function(b) {
                a.handleMouseOut.call(a, b);
            }));
        },
        dispDUpd: function() {
            this.skipEvents || (this.dispatchDataUpdated && (this.dispatchDataUpdated = !1, 
            this.fire({
                type: "dataUpdated",
                chart: this
            })), this.chartCreated || (this.chartCreated = !0, this.fire({
                type: "init",
                chart: this
            })), this.chartRendered || (this.fire({
                type: "rendered",
                chart: this
            }), this.chartRendered = !0), this.fire({
                type: "drawn",
                chart: this
            }));
            this.skipEvents = !1;
        },
        validateSize: function() {
            var a = this;
            a.premeasure();
            a.checkDisplay();
            if (a.divRealWidth != a.previousWidth || a.divRealHeight != a.previousHeight) {
                var b = a.legend;
                if (0 < a.realWidth && 0 < a.realHeight) {
                    a.sizeChanged = !0;
                    if (b) {
                        a.legendInitTO && clearTimeout(a.legendInitTO);
                        var c = setTimeout(function() {
                            b.invalidateSize();
                        }, 10);
                        a.timeOuts.push(c);
                        a.legendInitTO = c;
                    }
                    a.marginsUpdated = !1;
                    clearTimeout(a.initTO);
                    c = setTimeout(function() {
                        a.initChart();
                    }, 10);
                    a.timeOuts.push(c);
                    a.initTO = c;
                }
                a.renderFix();
                b && b.renderFix && b.renderFix();
                clearTimeout(a.resizedTO);
                a.resizedTO = setTimeout(function() {
                    a.fire({
                        type: "resized",
                        chart: a
                    });
                }, 10);
                a.previousHeight = a.divRealHeight;
                a.previousWidth = a.divRealWidth;
            }
        },
        invalidateSize: function() {
            this.previousHeight = this.previousWidth = 0/0;
            this.invalidateSizeReal();
        },
        invalidateSizeReal: function() {
            var a = this;
            a.marginsUpdated = !1;
            clearTimeout(a.validateTO);
            var b = setTimeout(function() {
                a.validateSize();
            }, 5);
            a.timeOuts.push(b);
            a.validateTO = b;
        },
        validateData: function(a) {
            this.chartCreated && (this.dataChanged = !0, this.marginsUpdated = !1, this.initChart(a));
        },
        validateNow: function(a, b) {
            this.initTO && clearTimeout(this.initTO);
            a && (this.dataChanged = !0, this.marginsUpdated = !1);
            this.skipEvents = b;
            this.chartRendered = !1;
            var c = this.legend;
            c && c.position != this.prevLegendPosition && (this.previousWidth = this.mw = 0, 
            c.invalidateSize && (c.invalidateSize(), this.validateSize()));
            this.write(this.div);
        },
        showItem: function(a) {
            a.hidden = !1;
            this.initChart();
        },
        hideItem: function(a) {
            a.hidden = !0;
            this.initChart();
        },
        hideBalloon: function() {
            var a = this;
            clearTimeout(a.hoverInt);
            clearTimeout(a.balloonTO);
            a.hoverInt = setTimeout(function() {
                a.hideBalloonReal.call(a);
            }, a.hideBalloonTime);
        },
        cleanChart: function() {},
        hideBalloonReal: function() {
            var a = this.balloon;
            a && a.hide && a.hide();
        },
        showBalloon: function(a, b, c, d, e) {
            var f = this;
            clearTimeout(f.balloonTO);
            clearTimeout(f.hoverInt);
            f.balloonTO = setTimeout(function() {
                f.showBalloonReal.call(f, a, b, c, d, e);
            }, 1);
        },
        showBalloonReal: function(a, b, c, d, e) {
            this.handleMouseMove();
            var f = this.balloon;
            f.enabled && (f.followCursor(!1), f.changeColor(b), !c || f.fixedPosition ? (f.setPosition(d, e), 
            isNaN(d) || isNaN(e) ? f.followCursor(!0) : f.followCursor(!1)) : f.followCursor(!0), 
            a && f.showBalloon(a));
        },
        handleMouseOver: function() {
            this.outTO && clearTimeout(this.outTO);
            a.resetMouseOver();
            this.mouseIsOver = !0;
        },
        handleMouseOut: function() {
            var b = this;
            a.resetMouseOver();
            b.outTO && clearTimeout(b.outTO);
            b.outTO = setTimeout(function() {
                b.handleMouseOutReal();
            }, 10);
        },
        handleMouseOutReal: function() {
            this.mouseIsOver = !1;
        },
        handleMouseMove: function(a) {
            a || (a = window.event);
            this.mouse2Y = this.mouse2X = 0/0;
            var b, c, d, e;
            if (a) {
                if (a.touches) {
                    var f = a.touches.item(1);
                    f && this.panEventsEnabled && this.boundingRect && (d = f.clientX - this.boundingRect.left, 
                    e = f.clientY - this.boundingRect.top);
                    a = a.touches.item(0);
                    if (!a) return;
                } else this.wasTouched = !1;
                this.boundingRect && a.clientX && (b = a.clientX - this.boundingRect.left, c = a.clientY - this.boundingRect.top);
                isNaN(d) ? this.mouseX = b : (this.mouseX = Math.min(b, d), this.mouse2X = Math.max(b, d));
                isNaN(e) ? this.mouseY = c : (this.mouseY = Math.min(c, e), this.mouse2Y = Math.max(c, e));
            }
        },
        handleTouchStart: function(a) {
            this.hideBalloonReal();
            a && (a.touches && this.tapToActivate && !this.tapped || !this.panRequired) || (this.handleMouseMove(a), 
            this.handleMouseDown(a));
        },
        handleTouchEnd: function(b) {
            this.wasTouched = !0;
            this.handleMouseMove(b);
            a.resetMouseOver();
            this.handleReleaseOutside(b);
        },
        handleReleaseOutside: function() {
            this.handleDocTouchEnd.call(this);
        },
        handleMouseDown: function(b) {
            a.resetMouseOver();
            this.mouseIsOver = !0;
            b && b.preventDefault && (this.panEventsEnabled ? b.preventDefault() : b.touches || b.preventDefault());
        },
        addLegend: function(b, c) {
            b = a.processObject(b, a.AmLegend, this.theme);
            b.divId = c;
            b.ieW = 0;
            var d;
            d = "object" != typeof c && c ? document.getElementById(c) : c;
            this.legend = b;
            b.chart = this;
            d ? (b.div = d, b.position = "outside", b.autoMargins = !1) : b.div = this.legendDiv;
            return b;
        },
        removeLegend: function() {
            this.legend = void 0;
            this.previousWidth = 0;
            this.legendDiv.innerHTML = "";
        },
        handleResize: function() {
            (a.isPercents(this.width) || a.isPercents(this.height)) && this.invalidateSizeReal();
            this.renderFix();
        },
        renderFix: function() {
            if (!a.VML) {
                var b = this.container;
                b && b.renderFix();
            }
        },
        getSVG: function() {
            if (a.hasSVG) return this.container;
        },
        animate: function(b, c, d, e, f, g, h) {
            b["an_" + c] && a.removeFromArray(this.animations, b["an_" + c]);
            d = {
                obj: b,
                frame: 0,
                attribute: c,
                from: d,
                to: e,
                time: f,
                effect: g,
                suffix: h
            };
            b["an_" + c] = d;
            this.animations.push(d);
            return d;
        },
        setLegendData: function(a) {
            var b = this.legend;
            b && b.setData(a);
        },
        stopAnim: function(b) {
            a.removeFromArray(this.animations, b);
        },
        updateAnimations: function() {
            var b;
            this.container && this.container.update();
            if (this.animations) for (b = this.animations.length - 1; 0 <= b; b--) {
                var c = this.animations[b], d = a.updateRate * c.time, e = c.frame + 1, f = c.obj, g = c.attribute;
                if (e <= d) {
                    c.frame++;
                    var h = Number(c.from), i = Number(c.to) - h, d = a[c.effect](0, e, h, i, d);
                    0 === i ? (this.animations.splice(b, 1), f.node.style[g] = Number(c.to) + c.suffix) : f.node.style[g] = d + c.suffix;
                } else f.node.style[g] = Number(c.to) + c.suffix, f.animationFinished = !0, this.animations.splice(b, 1);
            }
        },
        update: function() {
            this.updateAnimations();
            var a = this.animatable;
            if (0 < a.length) {
                for (var b = !0, c = a.length - 1; 0 <= c; c--) {
                    var d = a[c];
                    d && (d.animationFinished ? a.splice(c, 1) : b = !1);
                }
                b && (this.fire({
                    type: "animationFinished",
                    chart: this
                }), this.animatable = []);
            }
        },
        inIframe: function() {
            try {
                return window.self !== window.top;
            } catch (a) {
                return !0;
            }
        },
        brr: function() {
            if (!this.hideCredits) {
                var a = "amcharts.com", b = window.location.hostname.split("."), c;
                2 <= b.length && (c = b[b.length - 2] + "." + b[b.length - 1]);
                this.amLink && (b = this.amLink.parentNode) && b.removeChild(this.amLink);
                b = this.creditsPosition;
                if (c != a || !0 === this.inIframe()) {
                    var a = "http://www." + a, d = c = 0, e = this.realWidth, f = this.realHeight, g = this.type;
                    if ("serial" == g || "xy" == g || "gantt" == g) c = this.marginLeftReal, d = this.marginTopReal, 
                    e = c + this.plotAreaWidth, f = d + this.plotAreaHeight;
                    var g = a + "/javascript-charts/", h = "JavaScript charts", i = "";
                    "ammap" == this.product && (g = a + "/javascript-maps/", h = "Interactive JavaScript maps", 
                    i = "JS map by amCharts");
                    a = document.createElement("a");
                    i = document.createTextNode(i);
                    a.setAttribute("href", g);
                    a.setAttribute("title", h);
                    this.urlTarget && a.setAttribute("target", this.urlTarget);
                    a.appendChild(i);
                    this.chartDiv.appendChild(a);
                    this.amLink = a;
                    g = a.style;
                    g.position = "absolute";
                    g.textDecoration = "none";
                    g.color = this.color;
                    g.fontFamily = this.fontFamily;
                    g.fontSize = "11px";
                    g.opacity = .7;
                    g.display = "block";
                    var h = a.offsetWidth, a = a.offsetHeight, i = 5 + c, j = d + 5;
                    "bottom-left" == b && (i = 5 + c, j = f - a - 3);
                    "bottom-right" == b && (i = e - h - 5, j = f - a - 3);
                    "top-right" == b && (i = e - h - 5, j = d + 5);
                    g.left = i + "px";
                    g.top = j + "px";
                }
            }
        }
    });
    a.Slice = a.Class({
        construct: function() {}
    });
    a.SerialDataItem = a.Class({
        construct: function() {}
    });
    a.GraphDataItem = a.Class({
        construct: function() {}
    });
    a.Guide = a.Class({
        construct: function(b) {
            this.cname = "Guide";
            a.applyTheme(this, b, this.cname);
        }
    });
    a.Title = a.Class({
        construct: function(b) {
            this.cname = "Title";
            a.applyTheme(this, b, this.cname);
        }
    });
    a.Label = a.Class({
        construct: function(b) {
            this.cname = "Label";
            a.applyTheme(this, b, this.cname);
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.AmGraph = a.Class({
        construct: function(b) {
            this.cname = "AmGraph";
            this.createEvents("rollOverGraphItem", "rollOutGraphItem", "clickGraphItem", "doubleClickGraphItem", "rightClickGraphItem", "clickGraph", "rollOverGraph", "rollOutGraph");
            this.type = "line";
            this.stackable = !0;
            this.columnCount = 1;
            this.columnIndex = 0;
            this.centerCustomBullets = this.showBalloon = !0;
            this.maxBulletSize = 50;
            this.minBulletSize = 4;
            this.balloonText = "[[value]]";
            this.hidden = this.scrollbar = this.animationPlayed = !1;
            this.pointPosition = "middle";
            this.depthCount = 1;
            this.includeInMinMax = !0;
            this.negativeBase = 0;
            this.visibleInLegend = !0;
            this.showAllValueLabels = !1;
            this.showBulletsAt = this.showBalloonAt = "close";
            this.lineThickness = 1;
            this.dashLength = 0;
            this.connect = !0;
            this.lineAlpha = 1;
            this.bullet = "none";
            this.bulletBorderThickness = 2;
            this.bulletBorderAlpha = 0;
            this.bulletAlpha = 1;
            this.bulletSize = 8;
            this.cornerRadiusTop = this.hideBulletsCount = this.bulletOffset = 0;
            this.cursorBulletAlpha = 1;
            this.gradientOrientation = "vertical";
            this.dy = this.dx = 0;
            this.periodValue = "";
            this.clustered = !0;
            this.periodSpan = 1;
            this.y = this.x = 0;
            this.switchable = !0;
            this.tcc = this.minDistance = 1;
            this.labelRotation = 0;
            this.labelAnchor = "auto";
            this.labelOffset = 3;
            this.bcn = "graph-";
            this.dateFormat = "MMM DD, YYYY";
            this.noRounding = !0;
            a.applyTheme(this, b, this.cname);
        },
        init: function() {
            this.createBalloon();
        },
        draw: function() {
            var b = this.chart;
            b.isRolledOverBullet = !1;
            var c = b.type;
            if (b.drawGraphs) {
                isNaN(this.precision) || (this.numberFormatter ? this.numberFormatter.precision = this.precision : this.numberFormatter = {
                    precision: this.precision,
                    decimalSeparator: b.decimalSeparator,
                    thousandsSeparator: b.thousandsSeparator
                });
                var d = b.container;
                this.container = d;
                this.destroy();
                var e = d.set();
                this.set = e;
                e.translate(this.x, this.y);
                var f = d.set();
                this.bulletSet = f;
                f.translate(this.x, this.y);
                this.behindColumns ? (b.graphsBehindSet.push(e), b.bulletBehindSet.push(f)) : (b.graphsSet.push(e), 
                b.bulletSet.push(f));
                var g = this.bulletAxis;
                a.isString(g) && (this.bulletAxis = b.getValueAxisById(g));
                d = d.set();
                a.remove(this.columnsSet);
                this.columnsSet = d;
                a.setCN(b, e, "graph-" + this.type);
                a.setCN(b, e, "graph-" + this.id);
                a.setCN(b, f, "graph-" + this.type);
                a.setCN(b, f, "graph-" + this.id);
                this.columnsArray = [];
                this.ownColumns = [];
                this.allBullets = [];
                this.animationArray = [];
                f = this.labelPosition;
                f || (g = this.valueAxis.stackType, f = "top", "column" == this.type && (b.rotate && (f = "right"), 
                "100%" == g || "regular" == g) && (f = "middle"), this.labelPosition = f);
                a.ifArray(this.data) && (b = !1, "xy" == c ? this.xAxis.axisCreated && this.yAxis.axisCreated && (b = !0) : this.valueAxis.axisCreated && (b = !0), 
                !this.hidden && b && this.createGraph());
                e.push(d);
            }
        },
        createGraph: function() {
            var b = this, c = b.chart;
            b.startAlpha = c.startAlpha;
            b.seqAn = c.sequencedAnimation;
            b.baseCoord = b.valueAxis.baseCoord;
            void 0 === b.fillAlphas && (b.fillAlphas = 0);
            b.bulletColorR = b.bulletColor;
            void 0 === b.bulletColorR && (b.bulletColorR = b.lineColorR, b.bulletColorNegative = b.negativeLineColor);
            void 0 === b.bulletAlpha && (b.bulletAlpha = b.lineAlpha);
            if ("step" == d || a.VML) b.noRounding = !1;
            var d = c.type;
            "gantt" == d && (d = "serial");
            clearTimeout(b.playedTO);
            if (!isNaN(b.valueAxis.min) && !isNaN(b.valueAxis.max)) {
                switch (d) {
                  case "serial":
                    b.categoryAxis && (b.createSerialGraph(), "candlestick" == b.type && 1 > b.valueAxis.minMaxMultiplier && b.positiveClip(b.set));
                    break;

                  case "radar":
                    b.createRadarGraph();
                    break;

                  case "xy":
                    b.createXYGraph();
                }
                b.playedTO = setTimeout(function() {
                    b.setAnimationPlayed.call(b);
                }, 500 * b.chart.startDuration);
            }
        },
        setAnimationPlayed: function() {
            this.animationPlayed = !0;
        },
        createXYGraph: function() {
            var a = [], b = [], c = this.xAxis, d = this.yAxis;
            this.pmh = d.height;
            this.pmw = c.width;
            this.pmy = this.pmx = 0;
            var e;
            for (e = this.start; e <= this.end; e++) {
                var f = this.data[e].axes[c.id].graphs[this.id], g = f.values, h = g.x, i = g.y, g = c.getCoordinate(h, this.noRounding), j = d.getCoordinate(i, this.noRounding);
                if (!isNaN(h) && !isNaN(i) && (a.push(g), b.push(j), f.x = g, f.y = j, h = this.createBullet(f, g, j, e), 
                i = this.labelText)) {
                    var i = this.createLabel(f, i), k = 0;
                    h && (k = h.size);
                    this.positionLabel(f, g, j, i, k);
                }
            }
            this.drawLineGraph(a, b);
            this.launchAnimation();
        },
        createRadarGraph: function() {
            var a = this.valueAxis.stackType, b = [], c = [], d = [], e = [], f, g, h, i, j;
            for (j = this.start; j <= this.end; j++) {
                var k = this.data[j].axes[this.valueAxis.id].graphs[this.id], l, m;
                "none" == a || "3d" == a ? l = k.values.value : (l = k.values.close, m = k.values.open);
                if (isNaN(l)) this.connect || (this.drawLineGraph(b, c, d, e), b = [], c = [], d = [], 
                e = []); else {
                    var n = this.valueAxis.getCoordinate(l, this.noRounding) - this.height, n = n * this.valueAxis.rMultiplier, o = -360 / (this.end - this.start + 1) * j;
                    "middle" == this.valueAxis.pointPosition && (o -= 180 / (this.end - this.start + 1));
                    l = n * Math.sin(o / 180 * Math.PI);
                    n *= Math.cos(o / 180 * Math.PI);
                    b.push(l);
                    c.push(n);
                    if (!isNaN(m)) {
                        var p = this.valueAxis.getCoordinate(m, this.noRounding) - this.height, p = p * this.valueAxis.rMultiplier, q = p * Math.sin(o / 180 * Math.PI), o = p * Math.cos(o / 180 * Math.PI);
                        d.push(q);
                        e.push(o);
                        isNaN(h) && (h = q);
                        isNaN(i) && (i = o);
                    }
                    o = this.createBullet(k, l, n, j);
                    k.x = l;
                    k.y = n;
                    if (q = this.labelText) q = this.createLabel(k, q), p = 0, o && (p = o.size), this.positionLabel(k, l, n, q, p);
                    isNaN(f) && (f = l);
                    isNaN(g) && (g = n);
                }
            }
            b.push(f);
            c.push(g);
            isNaN(h) || (d.push(h), e.push(i));
            this.drawLineGraph(b, c, d, e);
            this.launchAnimation();
        },
        positionLabel: function(a, b, c, d, e) {
            if (d) {
                var f = this.chart, g = this.valueAxis, h = "middle", i = !1, j = this.labelPosition, k = d.getBBox(), l = this.chart.rotate, m = a.isNegative;
                c -= k.height / 4 / 2;
                void 0 !== a.labelIsNegative && (m = a.labelIsNegative);
                switch (j) {
                  case "right":
                    j = l ? m ? "left" : "right" : "right";
                    break;

                  case "top":
                    j = l ? "top" : m ? "bottom" : "top";
                    break;

                  case "bottom":
                    j = l ? "bottom" : m ? "top" : "bottom";
                    break;

                  case "left":
                    j = l ? m ? "right" : "left" : "left";
                }
                var n = a.columnGraphics, o = 0, p = 0;
                n && (o = n.x, p = n.y);
                var q = this.labelOffset;
                switch (j) {
                  case "right":
                    h = "start";
                    b += e / 2 + q;
                    break;

                  case "top":
                    c = g.reversed ? c + (e / 2 + k.height / 2 + q) : c - (e / 2 + k.height / 2 + q);
                    break;

                  case "bottom":
                    c = g.reversed ? c - (e / 2 + k.height / 2 + q) : c + (e / 2 + k.height / 2 + q);
                    break;

                  case "left":
                    h = "end";
                    b -= e / 2 + q;
                    break;

                  case "inside":
                    "column" == this.type && (i = !0, l ? m ? (h = "end", b = o - 3 - q) : (h = "start", 
                    b = o + 3 + q) : c = m ? p + 7 + q : p - 10 - q);
                    break;

                  case "middle":
                    "column" == this.type && (i = !0, l ? b -= (b - o) / 2 + q - 3 : c -= (c - p) / 2 + q - 3);
                }
                "auto" != this.labelAnchor && (h = this.labelAnchor);
                d.attr({
                    "text-anchor": h
                });
                this.labelRotation && d.rotate(this.labelRotation);
                d.translate(b, c);
                !this.showAllValueLabels && n && i && (k = d.getBBox(), k.height > a.columnHeight || k.width > a.columnWidth) && (d.remove(), 
                d = null);
                d && "radar" != f.type && (0 > b || b > this.width || 0 > c || c > this.height) && (d.remove(), 
                d = null);
                if (d && ("serial" == f.type || "gantt" == f.type)) if (l) {
                    if (0 > c || c > this.height) d.remove(), d = null;
                } else if (0 > b || b > this.width) d.remove(), d = null;
                d && this.allBullets.push(d);
                return d;
            }
        },
        getGradRotation: function() {
            var a = 270;
            "horizontal" == this.gradientOrientation && (a = 0);
            return this.gradientRotation = a;
        },
        createSerialGraph: function() {
            this.dashLengthSwitched = this.fillColorsSwitched = this.lineColorSwitched = void 0;
            var b = this.chart, c = this.id, d = this.index, e = this.data, f = this.chart.container, g = this.valueAxis, h = this.type, i = this.columnWidthReal, j = this.showBulletsAt;
            isNaN(this.columnWidth) || (i = this.columnWidth);
            isNaN(i) && (i = .8);
            var k = this.useNegativeColorIfDown, l = this.width, m = this.height, n = this.y, o = this.rotate, p = this.columnCount, q = a.toCoordinate(this.cornerRadiusTop, i / 2), r = this.connect, s = [], t = [], u, v, w, x, y = this.chart.graphs.length, z, A = this.dx / this.tcc, B = this.dy / this.tcc, C = g.stackType, D = this.start, E = this.end, F = this.scrollbar, G = "graph-column-";
            F && (G = "scrollbar-graph-column-");
            var H = this.categoryAxis, I = this.baseCoord, J = this.negativeBase, K = this.columnIndex, L = this.lineThickness, M = this.lineAlpha, N = this.lineColorR, O = this.dashLength, P = this.set, Q, R = this.getGradRotation(), S = this.chart.columnSpacing, T = H.cellWidth, U = (T * i - p) / p;
            S > U && (S = U);
            var V, W, X, Y = m, Z = l, $ = 0, _ = 0, ab, bb, cb, db, eb = this.fillColorsR, fb = this.negativeFillColors, gb = this.negativeLineColor, hb = this.fillAlphas, ib = this.negativeFillAlphas;
            "object" == typeof hb && (hb = hb[0]);
            "object" == typeof ib && (ib = ib[0]);
            var jb = this.noRounding;
            "step" == h && (jb = !1);
            var kb = g.getCoordinate(g.min);
            g.logarithmic && (kb = g.getCoordinate(g.minReal));
            this.minCoord = kb;
            this.resetBullet && (this.bullet = "none");
            if (!(F || "line" != h && "smoothedLine" != h && "step" != h || (1 == e.length && "step" != h && "none" == this.bullet && (this.bullet = "round", 
            this.resetBullet = !0), !fb && void 0 == gb || k))) {
                var lb = J;
                lb > g.max && (lb = g.max);
                lb < g.min && (lb = g.min);
                g.logarithmic && (lb = g.minReal);
                var mb = g.getCoordinate(lb), nb = g.getCoordinate(g.max);
                o ? (Y = m, Z = Math.abs(nb - mb), ab = m, bb = Math.abs(kb - mb), db = _ = 0, g.reversed ? ($ = 0, 
                cb = mb) : ($ = mb, cb = 0)) : (Z = l, Y = Math.abs(nb - mb), bb = l, ab = Math.abs(kb - mb), 
                cb = $ = 0, g.reversed ? (db = n, _ = mb) : db = mb);
            }
            var ob = Math.round;
            this.pmx = ob($);
            this.pmy = ob(_);
            this.pmh = ob(Y);
            this.pmw = ob(Z);
            this.nmx = ob(cb);
            this.nmy = ob(db);
            this.nmh = ob(ab);
            this.nmw = ob(bb);
            a.isModern || (this.nmy = this.nmx = 0, this.nmh = this.height);
            this.clustered || (p = 1);
            i = "column" == h ? (T * i - S * (p - 1)) / p : T * i;
            1 > i && (i = 1);
            var pb = this.fixedColumnWidth;
            isNaN(pb) || (i = pb);
            var qb;
            if ("line" == h || "step" == h || "smoothedLine" == h) {
                if (0 < D) {
                    for (qb = D - 1; -1 < qb; qb--) if (V = e[qb], W = V.axes[g.id].graphs[c], X = W.values.value, 
                    !isNaN(X)) {
                        D = qb;
                        break;
                    }
                    if (this.lineColorField) for (qb = D; -1 < qb; qb--) if (V = e[qb], W = V.axes[g.id].graphs[c], 
                    W.lineColor) {
                        this.bulletColorSwitched = this.lineColorSwitched = W.lineColor;
                        break;
                    }
                    if (this.fillColorsField) for (qb = D; -1 < qb; qb--) if (V = e[qb], W = V.axes[g.id].graphs[c], 
                    W.fillColors) {
                        this.fillColorsSwitched = W.fillColors;
                        break;
                    }
                    if (this.dashLengthField) for (qb = D; -1 < qb; qb--) if (V = e[qb], W = V.axes[g.id].graphs[c], 
                    !isNaN(W.dashLength)) {
                        this.dashLengthSwitched = W.dashLength;
                        break;
                    }
                }
                if (E < e.length - 1) for (qb = E + 1; qb < e.length; qb++) if (V = e[qb], W = V.axes[g.id].graphs[c], 
                X = W.values.value, !isNaN(X)) {
                    E = qb;
                    break;
                }
            }
            E < e.length - 1 && E++;
            var rb = [], sb = [], tb = !1;
            if ("line" == h || "step" == h || "smoothedLine" == h) if (this.stackable && "regular" == C || "100%" == C || this.fillToGraph) tb = !0;
            var ub = this.noStepRisers, vb = -1e3, wb = -1e3, xb = this.minDistance, yb = !0, zb = !1;
            for (qb = D; qb <= E; qb++) {
                V = e[qb];
                W = V.axes[g.id].graphs[c];
                W.index = qb;
                var Ab, Bb = 0/0;
                if (k && void 0 == this.openField) for (var Cb = qb + 1; Cb < e.length && (!e[Cb] || !(Ab = e[qb + 1].axes[g.id].graphs[c]) || !Ab.values || (Bb = Ab.values.value, 
                isNaN(Bb))); Cb++) ;
                var Db, Eb, Fb, Gb, Hb = 0/0, Ib = 0/0, Jb = 0/0, Kb = 0/0, Lb = 0/0, Mb = 0/0, Nb = 0/0, Ob = 0/0, Pb = 0/0, Qb = 0/0, Rb = 0/0, Sb = 0/0, Tb = 0/0, Ub = 0/0, Vb = 0/0, Wb = 0/0, Xb = 0/0, Yb = void 0, Zb = eb, $b = hb, _b = N, ac, bc, cc = this.proCandlesticks, dc = this.topRadius, ec = m - 1, fc = l - 1, gc = this.pattern;
                void 0 != W.pattern && (gc = W.pattern);
                isNaN(W.alpha) || ($b = W.alpha);
                isNaN(W.dashLength) || (O = W.dashLength);
                var hc = W.values;
                g.recalculateToPercents && (hc = W.percents);
                if (hc) {
                    Ub = this.stackable && "none" != C && "3d" != C ? hc.close : hc.value;
                    if ("candlestick" == h || "ohlc" == h) Ub = hc.close, Wb = hc.low, Nb = g.getCoordinate(Wb), 
                    Vb = hc.high, Pb = g.getCoordinate(Vb);
                    Xb = hc.open;
                    Jb = g.getCoordinate(Ub, jb);
                    isNaN(Xb) || (Lb = g.getCoordinate(Xb, jb), k && "regular" != C && "100%" != C && (Bb = Xb, 
                    Xb = Lb = 0/0));
                    k && (void 0 == this.openField ? Ab && (Ab.isNegative = Bb < Ub ? !0 : !1, isNaN(Bb) && (W.isNegative = !yb)) : W.isNegative = Bb > Ub ? !0 : !1);
                    if (!F) switch (this.showBalloonAt) {
                      case "close":
                        W.y = Jb;
                        break;

                      case "open":
                        W.y = Lb;
                        break;

                      case "high":
                        W.y = Pb;
                        break;

                      case "low":
                        W.y = Nb;
                    }
                    var Hb = V.x[H.id], ic = this.periodSpan - 1;
                    "step" != h || isNaN(V.cellWidth) || (T = V.cellWidth);
                    var jc = Math.floor(T / 2) + Math.floor(ic * T / 2), kc = jc, lc = 0;
                    "left" == this.stepDirection && (lc = (2 * T + ic * T) / 2, Hb -= lc);
                    "center" == this.stepDirection && (lc = T / 2, Hb -= lc);
                    "start" == this.pointPosition && (Hb -= T / 2 + Math.floor(ic * T / 2), jc = 0, 
                    kc = Math.floor(T) + Math.floor(ic * T));
                    "end" == this.pointPosition && (Hb += T / 2 + Math.floor(ic * T / 2), jc = Math.floor(T) + Math.floor(ic * T), 
                    kc = 0);
                    if (ub) {
                        var mc = this.columnWidth;
                        isNaN(mc) || (jc *= mc, kc *= mc);
                    }
                    F || (W.x = Hb);
                    -1e5 > Hb && (Hb = -1e5);
                    Hb > l + 1e5 && (Hb = l + 1e5);
                    o ? (Ib = Jb, Kb = Lb, Lb = Jb = Hb, isNaN(Xb) && !this.fillToGraph && (Kb = I), 
                    Mb = Nb, Ob = Pb) : (Kb = Ib = Hb, isNaN(Xb) && !this.fillToGraph && (Lb = I));
                    if (!cc && Ub < Xb || cc && Ub < Q) W.isNegative = !0, fb && (Zb = fb), ib && ($b = ib), 
                    void 0 != gb && (_b = gb);
                    zb = !1;
                    isNaN(Ub) || (k ? Ub > Bb ? (yb && (zb = !0), yb = !1) : (yb || (zb = !0), yb = !0) : W.isNegative = Ub < J ? !0 : !1, 
                    Q = Ub);
                    var nc = !1;
                    F && b.chartScrollbar.ignoreCustomColors && (nc = !0);
                    nc || (void 0 != W.color && (Zb = W.color), W.fillColors && (Zb = W.fillColors));
                    switch (h) {
                      case "line":
                        if (isNaN(Ub)) r || (this.drawLineGraph(s, t, rb, sb), s = [], t = [], rb = [], 
                        sb = []); else {
                            if (Math.abs(Ib - vb) >= xb || Math.abs(Jb - wb) >= xb) s.push(Ib), t.push(Jb), 
                            vb = Ib, wb = Jb;
                            Qb = Ib;
                            Rb = Jb;
                            Sb = Ib;
                            Tb = Jb;
                            !tb || isNaN(Lb) || isNaN(Kb) || (rb.push(Kb), sb.push(Lb));
                            if (zb || void 0 != W.lineColor && W.lineColor != this.lineColorSwitched || void 0 != W.fillColors && W.fillColors != this.fillColorsSwitched || !isNaN(W.dashLength)) this.drawLineGraph(s, t, rb, sb), 
                            s = [ Ib ], t = [ Jb ], rb = [], sb = [], !tb || isNaN(Lb) || isNaN(Kb) || (rb.push(Kb), 
                            sb.push(Lb)), k ? yb ? (this.lineColorSwitched = N, this.fillColorsSwitched = eb) : (this.lineColorSwitched = gb, 
                            this.fillColorsSwitched = fb) : (this.lineColorSwitched = W.lineColor, this.fillColorsSwitched = W.fillColors), 
                            this.dashLengthSwitched = W.dashLength;
                            W.gap && (this.drawLineGraph(s, t, rb, sb), s = [], t = [], rb = [], sb = []);
                        }
                        break;

                      case "smoothedLine":
                        if (isNaN(Ub)) r || (this.drawSmoothedGraph(s, t, rb, sb), s = [], t = [], rb = [], 
                        sb = []); else {
                            if (Math.abs(Ib - vb) >= xb || Math.abs(Jb - wb) >= xb) s.push(Ib), t.push(Jb), 
                            vb = Ib, wb = Jb;
                            Qb = Ib;
                            Rb = Jb;
                            Sb = Ib;
                            Tb = Jb;
                            !tb || isNaN(Lb) || isNaN(Kb) || (rb.push(Kb), sb.push(Lb));
                            void 0 == W.lineColor && void 0 == W.fillColors && isNaN(W.dashLength) || (this.drawSmoothedGraph(s, t, rb, sb), 
                            s = [ Ib ], t = [ Jb ], rb = [], sb = [], !tb || isNaN(Lb) || isNaN(Kb) || (rb.push(Kb), 
                            sb.push(Lb)), this.lineColorSwitched = W.lineColor, this.fillColorsSwitched = W.fillColors, 
                            this.dashLengthSwitched = W.dashLength);
                            W.gap && (this.drawSmoothedGraph(s, t, rb, sb), s = [], t = [], rb = [], sb = []);
                        }
                        break;

                      case "step":
                        if (!isNaN(Ub)) {
                            o ? (isNaN(u) || (s.push(u), t.push(Jb - jc)), t.push(Jb - jc), s.push(Ib), t.push(Jb + kc), 
                            s.push(Ib), !tb || isNaN(Lb) || isNaN(Kb) || (isNaN(w) || (rb.push(w), sb.push(Lb - jc)), 
                            rb.push(Kb), sb.push(Lb - jc), rb.push(Kb), sb.push(Lb + kc))) : (isNaN(v) || (t.push(v), 
                            s.push(Ib - jc)), s.push(Ib - jc), t.push(Jb), s.push(Ib + kc), t.push(Jb), !tb || isNaN(Lb) || isNaN(Kb) || (isNaN(x) || (rb.push(Kb - jc), 
                            sb.push(x)), rb.push(Kb - jc), sb.push(Lb), rb.push(Kb + kc), sb.push(Lb)));
                            u = Ib;
                            v = Jb;
                            w = Kb;
                            x = Lb;
                            Qb = Ib;
                            Rb = Jb;
                            Sb = Ib;
                            Tb = Jb;
                            if (zb || void 0 != W.lineColor || void 0 != W.fillColors || !isNaN(W.dashLength)) {
                                var oc = s[s.length - 2], pc = t[t.length - 2];
                                s.pop();
                                t.pop();
                                this.drawLineGraph(s, t, rb, sb);
                                s = [ oc ];
                                t = [ pc ];
                                o ? (t.push(Jb + kc), s.push(Ib)) : (s.push(Ib + kc), t.push(Jb));
                                rb = [];
                                sb = [];
                                this.lineColorSwitched = W.lineColor;
                                this.fillColorsSwitched = W.fillColors;
                                this.dashLengthSwitched = W.dashLength;
                                k && (yb ? (this.lineColorSwitched = N, this.fillColorsSwitched = eb) : (this.lineColorSwitched = gb, 
                                this.fillColorsSwitched = fb));
                            }
                            if (ub || W.gap) u = v = 0/0, this.drawLineGraph(s, t, rb, sb), s = [], t = [], 
                            rb = [], sb = [];
                        } else if (!r) {
                            if (1 >= this.periodSpan || 1 < this.periodSpan && Ib - u > jc + kc) u = v = 0/0;
                            this.drawLineGraph(s, t, rb, sb);
                            s = [];
                            t = [];
                            rb = [];
                            sb = [];
                        }
                        break;

                      case "column":
                        ac = _b;
                        void 0 != W.lineColor && (ac = W.lineColor);
                        if (!isNaN(Ub)) {
                            k || (W.isNegative = Ub < J ? !0 : !1);
                            W.isNegative && (fb && (Zb = fb), void 0 != gb && (ac = gb));
                            var qc = g.min, rc = g.max, sc = Xb;
                            isNaN(sc) && (sc = J);
                            if (!(Ub < qc && sc < qc || Ub > rc && sc > rc)) {
                                var tc;
                                if (o) {
                                    "3d" == C ? (Eb = Jb - (p / 2 - this.depthCount + 1) * (i + S) + S / 2 + B * K, 
                                    Db = Kb + A * K, tc = K) : (Eb = Math.floor(Jb - (p / 2 - K) * (i + S) + S / 2), 
                                    Db = Kb, tc = 0);
                                    Fb = i;
                                    Qb = Ib;
                                    Rb = Eb + i / 2;
                                    Sb = Ib;
                                    Tb = Eb + i / 2;
                                    Eb + Fb > m + tc * B && (Fb = m - Eb + tc * B);
                                    Eb < tc * B && (Fb += Eb, Eb = tc * B);
                                    Gb = Ib - Kb;
                                    var uc = Db;
                                    Db = a.fitToBounds(Db, 0, l);
                                    Gb += uc - Db;
                                    Gb = a.fitToBounds(Gb, -Db, l - Db + A * K);
                                    W.labelIsNegative = 0 > Gb ? !0 : !1;
                                    0 === Gb && 1 / Ub === 1 / -0 && (W.labelIsNegative = !0);
                                    isNaN(V.percentWidthValue) || (Fb = this.height * V.percentWidthValue / 100, Eb = Hb - Fb / 2, 
                                    Rb = Eb + Fb / 2);
                                    Fb = a.roundTo(Fb, 2);
                                    Gb = a.roundTo(Gb, 2);
                                    Eb < m && 0 < Fb && (Yb = new a.Cuboid(f, Gb, Fb, A - b.d3x, B - b.d3y, Zb, $b, L, ac, M, R, q, o, O, gc, dc, G), 
                                    W.columnWidth = Math.abs(Gb), W.columnHeight = Math.abs(Fb));
                                } else {
                                    "3d" == C ? (Db = Ib - (p / 2 - this.depthCount + 1) * (i + S) + S / 2 + A * K, 
                                    Eb = Lb + B * K, tc = K) : (Db = Ib - (p / 2 - K) * (i + S) + S / 2, Eb = Lb, tc = 0);
                                    Fb = i;
                                    Qb = Db + i / 2;
                                    Rb = Jb;
                                    Sb = Db + i / 2;
                                    Tb = Jb;
                                    Db + Fb > l + tc * A && (Fb = l - Db + tc * A);
                                    Db < tc * A && (Fb += Db - tc * A, Db = tc * A);
                                    Gb = Jb - Lb;
                                    W.labelIsNegative = 0 < Gb ? !0 : !1;
                                    0 === Gb && -0 === Ub && (W.labelIsNegative = !0);
                                    var vc = Eb;
                                    Eb = a.fitToBounds(Eb, this.dy, m);
                                    Gb += vc - Eb;
                                    Gb = a.fitToBounds(Gb, -Eb + B * K, m - Eb);
                                    isNaN(V.percentWidthValue) || (Fb = this.width * V.percentWidthValue / 100, Db = Hb - Fb / 2, 
                                    Qb = Db + Fb / 2);
                                    Fb = a.roundTo(Fb, 2);
                                    Gb = a.roundTo(Gb, 2);
                                    Db < l + K * A && 0 < Fb && (this.showOnAxis && (Eb -= B / 2), Yb = new a.Cuboid(f, Fb, Gb, A - b.d3x, B - b.d3y, Zb, $b, L, ac, this.lineAlpha, R, q, o, O, gc, dc, G), 
                                    W.columnHeight = Math.abs(Gb), W.columnWidth = Math.abs(Fb));
                                }
                            }
                            if (Yb) {
                                bc = Yb.set;
                                a.setCN(b, Yb.set, "graph-" + this.type);
                                a.setCN(b, Yb.set, "graph-" + this.id);
                                W.className && a.setCN(b, Yb.set, W.className, !0);
                                W.columnGraphics = bc;
                                Db = a.roundTo(Db, 2);
                                Eb = a.roundTo(Eb, 2);
                                bc.translate(Db, Eb);
                                (W.url || this.showHandOnHover) && bc.setAttr("cursor", "pointer");
                                if (!F) {
                                    "none" == C && (z = o ? (this.end + 1 - qb) * y - d : y * qb + d);
                                    "3d" == C && (o ? (z = (this.end + 1 - qb) * y - d - 1e3 * this.depthCount, Qb += A * this.columnIndex, 
                                    Sb += A * this.columnIndex, W.y += A * this.columnIndex) : (z = (y - d) * (qb + 1) + 1e3 * this.depthCount, 
                                    Rb += B * this.columnIndex, Tb += B * this.columnIndex, W.y += B * this.columnIndex));
                                    if ("regular" == C || "100%" == C) z = o ? 0 < hc.value ? (this.end + 1 - qb) * y + d : (this.end + 1 - qb) * y - d : 0 < hc.value ? y * qb + d : y * qb - d;
                                    this.columnsArray.push({
                                        column: Yb,
                                        depth: z
                                    });
                                    W.x = o ? Eb + Fb / 2 : Db + Fb / 2;
                                    this.ownColumns.push(Yb);
                                    this.animateColumns(Yb, qb, Ib, Kb, Jb, Lb);
                                    this.addListeners(bc, W);
                                }
                                this.columnsSet.push(bc);
                            }
                        }
                        break;

                      case "candlestick":
                        if (!isNaN(Xb) && !isNaN(Ub)) {
                            var wc, xc;
                            ac = _b;
                            void 0 != W.lineColor && (ac = W.lineColor);
                            Qb = Ib;
                            Tb = Rb = Jb;
                            Sb = Ib;
                            if (o) {
                                "open" == j && (Sb = Kb);
                                "high" == j && (Sb = Ob);
                                "low" == j && (Sb = Mb);
                                Ib = a.fitToBounds(Ib, 0, fc);
                                Kb = a.fitToBounds(Kb, 0, fc);
                                Mb = a.fitToBounds(Mb, 0, fc);
                                Ob = a.fitToBounds(Ob, 0, fc);
                                if (0 === Ib && 0 === Kb && 0 === Mb && 0 === Ob) continue;
                                if (Ib == fc && Kb == fc && Mb == fc && Ob == fc) continue;
                                Eb = Jb - i / 2;
                                Db = Kb;
                                Fb = i;
                                Eb + Fb > m && (Fb = m - Eb);
                                0 > Eb && (Fb += Eb, Eb = 0);
                                if (Eb < m && 0 < Fb) {
                                    var yc, zc;
                                    Ub > Xb ? (yc = [ Ib, Ob ], zc = [ Kb, Mb ]) : (yc = [ Kb, Ob ], zc = [ Ib, Mb ]);
                                    !isNaN(Ob) && !isNaN(Mb) && Jb < m && 0 < Jb && (wc = a.line(f, yc, [ Jb, Jb ], ac, M, L), 
                                    xc = a.line(f, zc, [ Jb, Jb ], ac, M, L));
                                    Gb = Ib - Kb;
                                    Yb = new a.Cuboid(f, Gb, Fb, A, B, Zb, hb, L, ac, M, R, q, o, O, gc, dc, G);
                                }
                            } else {
                                "open" == j && (Tb = Lb);
                                "high" == j && (Tb = Pb);
                                "low" == j && (Tb = Nb);
                                Jb = a.fitToBounds(Jb, 0, ec);
                                Lb = a.fitToBounds(Lb, 0, ec);
                                Nb = a.fitToBounds(Nb, 0, ec);
                                Pb = a.fitToBounds(Pb, 0, ec);
                                if (0 === Jb && 0 === Lb && 0 === Nb && 0 === Pb) continue;
                                if (Jb == ec && Lb == ec && Nb == ec && Pb == ec) continue;
                                Db = Ib - i / 2;
                                Eb = Lb + L / 2;
                                Fb = i;
                                Db + Fb > l && (Fb = l - Db);
                                0 > Db && (Fb += Db, Db = 0);
                                Gb = Jb - Lb;
                                if (Db < l && 0 < Fb) {
                                    cc && Ub >= Xb && ($b = 0);
                                    var Yb = new a.Cuboid(f, Fb, Gb, A, B, Zb, $b, L, ac, M, R, q, o, O, gc, dc, G), Ac, Bc;
                                    Ub > Xb ? (Ac = [ Jb, Pb ], Bc = [ Lb, Nb ]) : (Ac = [ Lb, Pb ], Bc = [ Jb, Nb ]);
                                    !isNaN(Pb) && !isNaN(Nb) && Ib < l && 0 < Ib && (wc = a.line(f, [ Ib, Ib ], Ac, ac, M, L), 
                                    xc = a.line(f, [ Ib, Ib ], Bc, ac, M, L), a.setCN(b, wc, this.bcn + "line-high"), 
                                    W.className && a.setCN(b, wc, W.className, !0), a.setCN(b, xc, this.bcn + "line-low"), 
                                    W.className && a.setCN(b, xc, W.className, !0));
                                }
                            }
                            Yb && (bc = Yb.set, W.columnGraphics = bc, P.push(bc), bc.translate(Db, Eb - L / 2), 
                            (W.url || this.showHandOnHover) && bc.setAttr("cursor", "pointer"), wc && (P.push(wc), 
                            P.push(xc)), F || (W.x = o ? Eb + Fb / 2 : Db + Fb / 2, this.animateColumns(Yb, qb, Ib, Kb, Jb, Lb), 
                            this.addListeners(bc, W)));
                        }
                        break;

                      case "ohlc":
                        if (!(isNaN(Xb) || isNaN(Vb) || isNaN(Wb) || isNaN(Ub))) {
                            var Cc = f.set();
                            P.push(Cc);
                            Ub < Xb && (W.isNegative = !0, void 0 != gb && (_b = gb));
                            var Dc, Ec, Fc;
                            if (o) {
                                Tb = Jb;
                                Sb = Ib;
                                "open" == j && (Sb = Kb);
                                "high" == j && (Sb = Ob);
                                "low" == j && (Sb = Mb);
                                Mb = a.fitToBounds(Mb, 0, fc);
                                Ob = a.fitToBounds(Ob, 0, fc);
                                if (0 === Ib && 0 === Kb && 0 === Mb && 0 === Ob) continue;
                                if (Ib == fc && Kb == fc && Mb == fc && Ob == fc) continue;
                                var Gc = Jb - i / 2, Gc = a.fitToBounds(Gc, 0, m), Hc = a.fitToBounds(Jb, 0, m), Ic = Jb + i / 2, Ic = a.fitToBounds(Ic, 0, m);
                                0 <= Kb && Kb <= fc && (Ec = a.line(f, [ Kb, Kb ], [ Gc, Hc ], _b, M, L, O));
                                0 < Jb && Jb < m && (Dc = a.line(f, [ Mb, Ob ], [ Jb, Jb ], _b, M, L, O));
                                0 <= Ib && Ib <= fc && (Fc = a.line(f, [ Ib, Ib ], [ Hc, Ic ], _b, M, L, O));
                            } else {
                                Tb = Jb;
                                "open" == j && (Tb = Lb);
                                "high" == j && (Tb = Pb);
                                "low" == j && (Tb = Nb);
                                var Sb = Ib, Nb = a.fitToBounds(Nb, 0, ec), Pb = a.fitToBounds(Pb, 0, ec), Jc = Ib - i / 2, Jc = a.fitToBounds(Jc, 0, l), Kc = a.fitToBounds(Ib, 0, l), Lc = Ib + i / 2, Lc = a.fitToBounds(Lc, 0, l);
                                0 <= Lb && Lb <= ec && (Ec = a.line(f, [ Jc, Kc ], [ Lb, Lb ], _b, M, L, O));
                                0 < Ib && Ib < l && (Dc = a.line(f, [ Ib, Ib ], [ Nb, Pb ], _b, M, L, O));
                                0 <= Jb && Jb <= ec && (Fc = a.line(f, [ Kc, Lc ], [ Jb, Jb ], _b, M, L, O));
                            }
                            P.push(Ec);
                            P.push(Dc);
                            P.push(Fc);
                            a.setCN(b, Ec, this.bcn + "stroke-open");
                            a.setCN(b, Fc, this.bcn + "stroke-close");
                            a.setCN(b, Dc, this.bcn + "stroke");
                            W.className && a.setCN(b, Cc, W.className, !0);
                            Qb = Ib;
                            Rb = Jb;
                        }
                    }
                    if (!F && !isNaN(Ub)) {
                        var Mc = this.hideBulletsCount;
                        if (this.end - this.start <= Mc || 0 === Mc) {
                            var Nc = this.createBullet(W, Sb, Tb, qb), Oc = this.labelText;
                            if (Oc && !isNaN(Qb) && !isNaN(Qb)) {
                                var Pc = this.createLabel(W, Oc), Qc = 0;
                                Nc && (Qc = Nc.size);
                                this.positionLabel(W, Qb, Rb, Pc, Qc);
                            }
                            if ("regular" == C || "100%" == C) {
                                var Rc = g.totalText;
                                if (Rc) {
                                    var Sc = this.createLabel(W, Rc, g.totalTextColor);
                                    a.setCN(b, Sc, this.bcn + "label-total");
                                    this.allBullets.push(Sc);
                                    if (Sc) {
                                        var Tc = Sc.getBBox(), Uc = Tc.width, Vc = Tc.height, Wc, Xc, Yc = g.totalTextOffset, Zc = g.totals[qb];
                                        Zc && Zc.remove();
                                        var $c = 0;
                                        "column" != h && ($c = this.bulletSize);
                                        o ? (Xc = Rb, Wc = 0 > Ub ? Ib - Uc / 2 - 2 - $c - Yc : Ib + Uc / 2 + 3 + $c + Yc) : (Wc = Qb, 
                                        Xc = 0 > Ub ? Jb + Vc / 2 + $c + Yc : Jb - Vc / 2 - 3 - $c - Yc);
                                        Sc.translate(Wc, Xc);
                                        g.totals[qb] = Sc;
                                        o ? (0 > Xc || Xc > m) && Sc.remove() : (0 > Wc || Wc > l) && Sc.remove();
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if ("line" == h || "step" == h || "smoothedLine" == h) "smoothedLine" == h ? this.drawSmoothedGraph(s, t, rb, sb) : this.drawLineGraph(s, t, rb, sb), 
            F || this.launchAnimation();
            this.bulletsHidden && this.hideBullets();
            this.customBulletsHidden && this.hideCustomBullets();
        },
        animateColumns: function(a, b) {
            var c = this, d = c.chart.startDuration;
            0 < d && !c.animationPlayed && (c.seqAn ? (a.set.hide(), c.animationArray.push(a), 
            d = setTimeout(function() {
                c.animate.call(c);
            }, d / (c.end - c.start + 1) * (b - c.start) * 1e3), c.timeOuts.push(d)) : c.animate(a), 
            c.chart.animatable.push(a));
        },
        createLabel: function(b, c, d) {
            var e = this.chart, f = b.labelColor;
            f || (f = this.color);
            f || (f = e.color);
            d && (f = d);
            d = this.fontSize;
            void 0 === d && (this.fontSize = d = e.fontSize);
            var g = this.labelFunction;
            c = e.formatString(c, b);
            c = a.cleanFromEmpty(c);
            g && (c = g(b, c));
            if (void 0 !== c && "" !== c) return b = a.text(this.container, c, f, e.fontFamily, d), 
            b.node.style.pointerEvents = "none", a.setCN(e, b, this.bcn + "label"), this.bulletSet.push(b), 
            b;
        },
        positiveClip: function(a) {
            a.clipRect(this.pmx, this.pmy, this.pmw, this.pmh);
        },
        negativeClip: function(a) {
            a.clipRect(this.nmx, this.nmy, this.nmw, this.nmh);
        },
        drawLineGraph: function(b, c, d, e) {
            var f = this;
            if (1 < b.length) {
                var g = f.noRounding, h = f.set, i = f.chart, j = f.container, k = j.set(), l = j.set();
                h.push(l);
                h.push(k);
                var m = f.lineAlpha, n = f.lineThickness, h = f.fillAlphas, o = f.lineColorR, p = f.negativeLineAlpha;
                isNaN(p) && (p = m);
                var q = f.lineColorSwitched;
                q && (o = q);
                var q = f.fillColorsR, r = f.fillColorsSwitched;
                r && (q = r);
                var s = f.dashLength;
                (r = f.dashLengthSwitched) && (s = r);
                var r = f.negativeLineColor, t = f.negativeFillColors, u = f.negativeFillAlphas, v = f.baseCoord;
                0 !== f.negativeBase && (v = f.valueAxis.getCoordinate(f.negativeBase, g), v > f.height && (v = f.height), 
                0 > v && (v = 0));
                m = a.line(j, b, c, o, m, n, s, !1, !0, g);
                a.setCN(i, m, f.bcn + "stroke");
                k.push(m);
                k.click(function(a) {
                    f.handleGraphEvent(a, "clickGraph");
                }).mouseover(function(a) {
                    f.handleGraphEvent(a, "rollOverGraph");
                }).mouseout(function(a) {
                    f.handleGraphEvent(a, "rollOutGraph");
                }).touchmove(function(a) {
                    f.chart.handleMouseMove(a);
                }).touchend(function(a) {
                    f.chart.handleTouchEnd(a);
                });
                void 0 === r || f.useNegativeColorIfDown || (n = a.line(j, b, c, r, p, n, s, !1, !0, g), 
                a.setCN(i, n, f.bcn + "stroke"), a.setCN(i, n, f.bcn + "stroke-negative"), l.push(n));
                if (0 < h || 0 < u) if (n = b.join(";").split(";"), p = c.join(";").split(";"), 
                m = i.type, "serial" == m || "radar" == m ? 0 < d.length ? (d.reverse(), e.reverse(), 
                n = b.concat(d), p = c.concat(e)) : "radar" == m ? (p.push(0), n.push(0)) : f.rotate ? (p.push(p[p.length - 1]), 
                n.push(v), p.push(p[0]), n.push(v), p.push(p[0]), n.push(n[0])) : (n.push(n[n.length - 1]), 
                p.push(v), n.push(n[0]), p.push(v), n.push(b[0]), p.push(p[0])) : "xy" == m && (c = f.fillToAxis) && (a.isString(c) && (c = i.getValueAxisById(c)), 
                "H" == c.orientation ? (v = "top" == c.position ? 0 : c.height, n.push(n[n.length - 1]), 
                p.push(v), n.push(n[0]), p.push(v), n.push(b[0]), p.push(p[0])) : (v = "left" == c.position ? 0 : c.width, 
                p.push(p[p.length - 1]), n.push(v), p.push(p[0]), n.push(v), p.push(p[0]), n.push(n[0]))), 
                b = f.gradientRotation, 0 < h && (c = a.polygon(j, n, p, q, h, 1, "#000", 0, b, g), 
                c.pattern(f.pattern, 0/0, i.path), a.setCN(i, c, f.bcn + "fill"), k.push(c)), t || void 0 !== r) isNaN(u) && (u = h), 
                t || (t = r), g = a.polygon(j, n, p, t, u, 1, "#000", 0, b, g), a.setCN(i, g, f.bcn + "fill"), 
                a.setCN(i, g, f.bcn + "fill-negative"), g.pattern(f.pattern, 0/0, i.path), l.push(g), 
                l.click(function(a) {
                    f.handleGraphEvent(a, "clickGraph");
                }).mouseover(function(a) {
                    f.handleGraphEvent(a, "rollOverGraph");
                }).mouseout(function(a) {
                    f.handleGraphEvent(a, "rollOutGraph");
                }).touchmove(function(a) {
                    f.chart.handleMouseMove(a);
                }).touchend(function(a) {
                    f.chart.handleTouchEnd(a);
                });
                f.applyMask(l, k);
            }
        },
        applyMask: function(a, b) {
            var c = a.length();
            "serial" != this.chart.type || this.scrollbar || (this.positiveClip(b), 0 < c && this.negativeClip(a));
        },
        drawSmoothedGraph: function(b, c, d, e) {
            if (1 < b.length) {
                var f = this.set, g = this.chart, h = this.container, i = h.set(), j = h.set();
                f.push(j);
                f.push(i);
                var k = this.lineAlpha, l = this.lineThickness, f = this.dashLength, m = this.fillAlphas, n = this.lineColorR, o = this.fillColorsR, p = this.negativeLineColor, q = this.negativeFillColors, r = this.negativeFillAlphas, s = this.baseCoord, t = this.lineColorSwitched;
                t && (n = t);
                (t = this.fillColorsSwitched) && (o = t);
                var u = this.negativeLineAlpha;
                isNaN(u) && (u = k);
                t = this.getGradRotation();
                k = new a.Bezier(h, b, c, n, k, l, o, 0, f, void 0, t);
                a.setCN(g, k, this.bcn + "stroke");
                i.push(k.path);
                void 0 !== p && (l = new a.Bezier(h, b, c, p, u, l, o, 0, f, void 0, t), a.setCN(g, l, this.bcn + "stroke"), 
                a.setCN(g, l, this.bcn + "stroke-negative"), j.push(l.path));
                0 < m && (k = b.join(";").split(";"), n = c.join(";").split(";"), l = "", 0 < d.length ? (d.push("M"), 
                e.push("M"), d.reverse(), e.reverse(), k = b.concat(d), n = c.concat(e)) : (this.rotate ? (l += " L" + s + "," + c[c.length - 1], 
                l += " L" + s + "," + c[0]) : (l += " L" + b[b.length - 1] + "," + s, l += " L" + b[0] + "," + s), 
                l += " L" + b[0] + "," + c[0]), d = new a.Bezier(h, k, n, 0/0, 0, 0, o, m, f, l, t), 
                a.setCN(g, d, this.bcn + "fill"), d.path.pattern(this.pattern, 0/0, g.path), i.push(d.path), 
                q || void 0 !== p) && (r || (r = m), q || (q = p), b = new a.Bezier(h, b, c, 0/0, 0, 0, q, r, f, l, t), 
                b.path.pattern(this.pattern, 0/0, g.path), a.setCN(g, b, this.bcn + "fill"), a.setCN(g, b, this.bcn + "fill-negative"), 
                j.push(b.path));
                this.applyMask(j, i);
            }
        },
        launchAnimation: function() {
            var b = this, c = b.chart.startDuration;
            if (0 < c && !b.animationPlayed) {
                var d = b.set, e = b.bulletSet;
                a.VML || (d.attr({
                    opacity: b.startAlpha
                }), e.attr({
                    opacity: b.startAlpha
                }));
                d.hide();
                e.hide();
                b.seqAn ? (c = setTimeout(function() {
                    b.animateGraphs.call(b);
                }, b.index * c * 1e3), b.timeOuts.push(c)) : b.animateGraphs();
            }
        },
        animateGraphs: function() {
            var a = this.chart, b = this.set, c = this.bulletSet, d = this.x, e = this.y;
            b.show();
            c.show();
            var f = a.startDuration, g = a.startEffect;
            b && (this.rotate ? (b.translate(-1e3, e), c.translate(-1e3, e)) : (b.translate(d, -1e3), 
            c.translate(d, -1e3)), b.animate({
                opacity: 1,
                translate: d + "," + e
            }, f, g), c.animate({
                opacity: 1,
                translate: d + "," + e
            }, f, g), a.animatable.push(b));
        },
        animate: function(b) {
            var c = this.chart, d = this.animationArray;
            !b && 0 < d.length && (b = d[0], d.shift());
            d = a[a.getEffect(c.startEffect)];
            c = c.startDuration;
            b && (this.rotate ? b.animateWidth(c, d) : b.animateHeight(c, d), b.set.show());
        },
        legendKeyColor: function() {
            var a = this.legendColor, b = this.lineAlpha;
            void 0 === a && (a = this.lineColorR, 0 === b && (b = this.fillColorsR) && (a = "object" == typeof b ? b[0] : b));
            return a;
        },
        legendKeyAlpha: function() {
            var a = this.legendAlpha;
            void 0 === a && (a = this.lineAlpha, this.fillAlphas > a && (a = this.fillAlphas), 
            0 === a && (a = this.bulletAlpha), 0 === a && (a = 1));
            return a;
        },
        createBullet: function(b, c, d) {
            if (!isNaN(c) && !isNaN(d) && ("none" != this.bullet || this.customBullet || b.bullet || b.customBullet)) {
                var e = this.chart, f = this.container, g = this.bulletOffset, h = this.bulletSize;
                isNaN(b.bulletSize) || (h = b.bulletSize);
                var i = b.values.value, j = this.maxValue, k = this.minValue, l = this.maxBulletSize, m = this.minBulletSize;
                isNaN(j) || (isNaN(i) || (h = (i - k) / (j - k) * (l - m) + m), k == j && (h = l));
                j = h;
                this.bulletAxis && (h = b.values.error, isNaN(h) || (i = h), h = this.bulletAxis.stepWidth * i);
                h < this.minBulletSize && (h = this.minBulletSize);
                this.rotate ? c = b.isNegative ? c - g : c + g : d = b.isNegative ? d + g : d - g;
                m = this.bulletColorR;
                b.lineColor && (this.bulletColorSwitched = b.lineColor);
                this.bulletColorSwitched && (m = this.bulletColorSwitched);
                b.isNegative && void 0 !== this.bulletColorNegative && (m = this.bulletColorNegative);
                void 0 !== b.color && (m = b.color);
                var n;
                "xy" == e.type && this.valueField && (n = this.pattern, b.pattern && (n = b.pattern));
                g = this.bullet;
                b.bullet && (g = b.bullet);
                var i = this.bulletBorderThickness, k = this.bulletBorderColorR, l = this.bulletBorderAlpha, o = this.bulletAlpha;
                k || (k = m);
                this.useLineColorForBulletBorder && (k = this.lineColorR, this.lineColorSwitched && (k = this.lineColorSwitched));
                var p = b.alpha;
                isNaN(p) || (o = p);
                n = a.bullet(f, g, h, m, o, i, k, l, j, 0, n, e.path);
                j = this.customBullet;
                b.customBullet && (j = b.customBullet);
                j && (n && n.remove(), "function" == typeof j ? (j = new j(), j.chart = e, b.bulletConfig && (j.availableSpace = d, 
                j.graph = this, j.graphDataItem = b, j.bulletY = d, b.bulletConfig.minCoord = this.minCoord - d, 
                j.bulletConfig = b.bulletConfig), j.write(f), n && j.showBullet && j.set.push(n), 
                b.customBulletGraphics = j.cset, n = j.set) : (n = f.set(), j = f.image(j, 0, 0, h, h), 
                n.push(j), this.centerCustomBullets && j.translate(-h / 2, -h / 2)));
                if (n) {
                    (b.url || this.showHandOnHover) && n.setAttr("cursor", "pointer");
                    if ("serial" == e.type || "gantt" == e.type) if (-.5 > c || c > this.width || d < -h / 2 || d > this.height) n.remove(), 
                    n = null;
                    n && (this.bulletSet.push(n), n.translate(c, d), this.addListeners(n, b), this.allBullets.push(n));
                    b.bx = c;
                    b.by = d;
                    a.setCN(e, n, this.bcn + "bullet");
                    b.className && a.setCN(e, n, b.className, !0);
                }
                if (n) {
                    n.size = h || 0;
                    if (e = this.bulletHitAreaSize) f = a.circle(f, e, "#FFFFFF", .001, 0), f.translate(c, d), 
                    b.hitBullet = f, this.bulletSet.push(f), this.addListeners(f, b);
                    b.bulletGraphics = n;
                } else n = {
                    size: 0
                };
                n.graphDataItem = b;
                return n;
            }
        },
        showBullets: function() {
            var a = this.allBullets, b;
            this.bulletsHidden = !1;
            for (b = 0; b < a.length; b++) a[b].show();
        },
        hideBullets: function() {
            var a = this.allBullets, b;
            this.bulletsHidden = !0;
            for (b = 0; b < a.length; b++) a[b].hide();
        },
        showCustomBullets: function() {
            var a = this.allBullets, b;
            this.customBulletsHidden = !1;
            for (b = 0; b < a.length; b++) {
                var c = a[b].graphDataItem;
                c.customBulletGraphics && c.customBulletGraphics.show();
            }
        },
        hideCustomBullets: function() {
            var a = this.allBullets, b;
            this.customBulletsHidden = !0;
            for (b = 0; b < a.length; b++) {
                var c = a[b].graphDataItem;
                c.customBulletGraphics && c.customBulletGraphics.hide();
            }
        },
        addListeners: function(a, b) {
            var c = this;
            a.mouseover(function(a) {
                c.handleRollOver(b, a);
            }).mouseout(function(a) {
                c.handleRollOut(b, a);
            }).touchend(function(a) {
                c.handleRollOver(b, a);
                c.chart.panEventsEnabled && c.handleClick(b, a);
            }).touchstart(function(a) {
                c.handleRollOver(b, a);
            }).click(function(a) {
                c.handleClick(b, a);
            }).dblclick(function(a) {
                c.handleDoubleClick(b, a);
            }).contextmenu(function(a) {
                c.handleRightClick(b, a);
            });
        },
        handleRollOver: function(a, b) {
            this.handleGraphEvent(b, "rollOverGraph");
            if (a) {
                var c = this.chart;
                c.isRolledOverBullet = !0;
                var d = {
                    type: "rollOverGraphItem",
                    item: a,
                    index: a.index,
                    graph: this,
                    target: this,
                    chart: this.chart,
                    event: b
                };
                this.fire(d);
                c.fire(d);
                clearTimeout(c.hoverInt);
                (c = c.chartCursor) && c.valueBalloonsEnabled || this.showGraphBalloon(a, "V", !0);
            }
        },
        handleRollOut: function(a, b) {
            if (a) {
                var c = this.chart, d = {
                    type: "rollOutGraphItem",
                    item: a,
                    index: a.index,
                    graph: this,
                    target: this,
                    chart: this.chart,
                    event: b
                };
                this.fire(d);
                c.fire(d);
                c.isRolledOverBullet = !1;
            }
            this.handleGraphEvent(b, "rollOutGraph");
            c = this.chart;
            (c = c.chartCursor) && c.valueBalloonsEnabled || this.hideBalloon();
        },
        handleClick: function(b, c) {
            if (!this.chart.checkTouchMoved() && this.chart.checkTouchDuration()) {
                if (b) {
                    var d = {
                        type: "clickGraphItem",
                        item: b,
                        index: b.index,
                        graph: this,
                        target: this,
                        chart: this.chart,
                        event: c
                    };
                    this.fire(d);
                    this.chart.fire(d);
                    a.getURL(b.url, this.urlTarget);
                }
                this.handleGraphEvent(c, "clickGraph");
            }
        },
        handleGraphEvent: function(a, b) {
            var c = {
                type: b,
                graph: this,
                target: this,
                chart: this.chart,
                event: a
            };
            this.fire(c);
            this.chart.fire(c);
        },
        handleRightClick: function(a, b) {
            if (a) {
                var c = {
                    type: "rightClickGraphItem",
                    item: a,
                    index: a.index,
                    graph: this,
                    target: this,
                    chart: this.chart,
                    event: b
                };
                this.fire(c);
                this.chart.fire(c);
            }
        },
        handleDoubleClick: function(a, b) {
            if (a) {
                var c = {
                    type: "doubleClickGraphItem",
                    item: a,
                    index: a.index,
                    graph: this,
                    target: this,
                    chart: this.chart,
                    event: b
                };
                this.fire(c);
                this.chart.fire(c);
            }
        },
        zoom: function(a, b) {
            this.start = a;
            this.end = b;
            this.draw();
        },
        changeOpacity: function(a) {
            var b = this.set;
            b && b.setAttr("opacity", a);
            if (b = this.ownColumns) {
                var c;
                for (c = 0; c < b.length; c++) {
                    var d = b[c].set;
                    d && d.setAttr("opacity", a);
                }
            }
            (b = this.bulletSet) && b.setAttr("opacity", a);
        },
        destroy: function() {
            a.remove(this.set);
            a.remove(this.bulletSet);
            var b = this.timeOuts;
            if (b) {
                var c;
                for (c = 0; c < b.length; c++) clearTimeout(b[c]);
            }
            this.timeOuts = [];
        },
        createBalloon: function() {
            var b = this.chart;
            this.balloon ? this.balloon.destroy && this.balloon.destroy() : this.balloon = {};
            var c = this.balloon;
            a.extend(c, b.balloon, !0);
            c.chart = b;
            c.mainSet = b.plotBalloonsSet;
            c.className = this.id;
        },
        hideBalloon: function() {
            var a = this, b = a.chart;
            b.chartCursor ? b.chartCursor.valueBalloonsEnabled || b.hideBalloon() : b.hideBalloon();
            clearTimeout(a.hoverInt);
            a.hoverInt = setTimeout(function() {
                a.hideBalloonReal.call(a);
            }, b.hideBalloonTime);
        },
        hideBalloonReal: function() {
            this.balloon && this.balloon.hide();
            this.fixBulletSize();
        },
        fixBulletSize: function() {
            if (a.isModern) {
                var b = this.resizedDItem;
                if (b) {
                    var c = b.bulletGraphics;
                    c && !c.doNotScale && (c.translate(b.bx, b.by, 1), c.setAttr("fill-opacity", this.bulletAlpha), 
                    c.setAttr("stroke-opacity", this.bulletBorderAlpha));
                }
                this.resizedDItem = null;
            }
        },
        showGraphBalloon: function(b, c, d, e, f) {
            var g = this.chart, h = this.balloon, i = 0, j = 0, k = g.chartCursor, l = !0;
            k ? k.valueBalloonsEnabled || (h = g.balloon, i = this.x, j = this.y, l = !1) : (h = g.balloon, 
            i = this.x, j = this.y, l = !1);
            clearTimeout(this.hoverInt);
            if (g.chartCursor && (this.currentDataItem = b, "serial" == g.type && g.isRolledOverBullet && g.chartCursor.valueBalloonsEnabled)) {
                this.hideBalloonReal();
                return;
            }
            this.resizeBullet(b, e, f);
            if (h && h.enabled && this.showBalloon && !this.hidden) {
                var k = g.formatString(this.balloonText, b, !0), m = this.balloonFunction;
                m && (k = m(b, b.graph));
                k && (k = a.cleanFromEmpty(k));
                k && "" !== k ? (e = g.getBalloonColor(this, b), h.drop || (h.pointerOrientation = c), 
                c = b.x, f = b.y, g.rotate && (c = b.y, f = b.x), c += i, f += j, isNaN(c) || isNaN(f) ? this.hideBalloonReal() : (b = this.width, 
                m = this.height, l && h.setBounds(i, j, b + i, m + j), h.changeColor(e), h.setPosition(c, f), 
                h.fixPrevious(), h.fixedPosition && (d = !1), !d && "radar" != g.type && (c < i || c > b + i || f < j || f > m + j) ? (h.showBalloon(k), 
                h.hide(0)) : (h.followCursor(d), h.showBalloon(k)))) : (this.hideBalloonReal(), 
                this.resizeBullet(b, e, f));
            } else this.hideBalloonReal();
        },
        resizeBullet: function(b, c, d) {
            this.fixBulletSize();
            if (b && a.isModern && (1 != c || !isNaN(d))) {
                var e = b.bulletGraphics;
                e && !e.doNotScale && (e.translate(b.bx, b.by, c), isNaN(d) || (e.setAttr("fill-opacity", d), 
                e.setAttr("stroke-opacity", d)), this.resizedDItem = b);
            }
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.ChartCursor = a.Class({
        construct: function(b) {
            this.cname = "ChartCursor";
            this.createEvents("changed", "zoomed", "onHideCursor", "onShowCursor", "draw", "selected", "moved", "panning", "zoomStarted");
            this.enabled = !0;
            this.cursorAlpha = 1;
            this.selectionAlpha = .2;
            this.cursorColor = "#CC0000";
            this.categoryBalloonAlpha = 1;
            this.color = "#FFFFFF";
            this.type = "cursor";
            this.zoomed = !1;
            this.zoomable = !0;
            this.pan = !1;
            this.categoryBalloonDateFormat = "MMM DD, YYYY";
            this.categoryBalloonText = "[[category]]";
            this.categoryBalloonEnabled = this.valueBalloonsEnabled = !0;
            this.rolledOver = !1;
            this.cursorPosition = "middle";
            this.bulletsEnabled = this.skipZoomDispatch = !1;
            this.bulletSize = 8;
            this.selectWithoutZooming = this.oneBalloonOnly = !1;
            this.graphBulletSize = 1.7;
            this.animationDuration = .3;
            this.zooming = !1;
            this.adjustment = 0;
            this.avoidBalloonOverlapping = !0;
            this.leaveCursor = !1;
            this.leaveAfterTouch = !0;
            this.valueZoomable = !1;
            this.balloonPointerOrientation = "horizontal";
            this.hLineEnabled = this.vLineEnabled = !0;
            this.vZoomEnabled = this.hZoomEnabled = !1;
            a.applyTheme(this, b, this.cname);
        },
        draw: function() {
            this.destroy();
            var b = this.chart;
            b.panRequired = !0;
            var c = b.container;
            this.rotate = b.rotate;
            this.container = c;
            this.prevLineHeight = this.prevLineWidth = 0/0;
            c = c.set();
            c.translate(this.x, this.y);
            this.set = c;
            b.cursorSet.push(c);
            this.createElements();
            a.isString(this.limitToGraph) && (this.limitToGraph = a.getObjById(b.graphs, this.limitToGraph), 
            this.fullWidth = !1, this.cursorPosition = "middle");
            this.pointer = this.balloonPointerOrientation.substr(0, 1).toUpperCase();
            this.isHidden = !1;
            this.hideLines();
            this.valueLineAxis || (this.valueLineAxis = b.valueAxes[0]);
        },
        createElements: function() {
            var b = this.chart, c = b.dx, d = b.dy, e = this.width, f = this.height, g, h, i = this.cursorAlpha, j = this.valueLineAlpha;
            this.rotate ? (g = j, h = i) : (h = j, g = i);
            "xy" == b.type && (h = i, void 0 !== j && (h = j), g = i);
            this.vvLine = a.line(this.container, [ c, 0, 0 ], [ d, 0, f ], this.cursorColor, g, 1);
            a.setCN(b, this.vvLine, "cursor-line");
            a.setCN(b, this.vvLine, "cursor-line-vertical");
            this.hhLine = a.line(this.container, [ 0, e, e + c ], [ 0, 0, d ], this.cursorColor, h, 1);
            a.setCN(b, this.hhLine, "cursor-line");
            a.setCN(b, this.hhLine, "cursor-line-horizontal");
            this.vLine = this.rotate ? this.vvLine : this.hhLine;
            this.set.push(this.vvLine);
            this.set.push(this.hhLine);
            this.set.node.style.pointerEvents = "none";
            this.fullLines = this.container.set();
            b = b.cursorLineSet;
            b.push(this.fullLines);
            b.translate(this.x, this.y);
            b.clipRect(0, 0, e, f);
            this.set.clipRect(0, 0, e, f);
        },
        update: function() {
            var a = this.chart, b = a.mouseX - this.x, c = a.mouseY - this.y;
            this.mouseX = b;
            this.mouseY = c;
            this.mouse2X = a.mouse2X - this.x;
            this.mouse2Y = a.mouse2Y - this.y;
            var d;
            if (a.chartData && 0 < a.chartData.length) {
                this.mouseIsOver() ? (this.hideGraphBalloons = !1, this.rolledOver = d = !0, this.updateDrawing(), 
                this.vvLine && isNaN(this.fx) && (a.rotate || !this.limitToGraph) && this.vvLine.translate(b, 0), 
                !this.hhLine || !isNaN(this.fy) || a.rotate && this.limitToGraph || this.hhLine.translate(0, c), 
                isNaN(this.mouse2X) ? this.dispatchMovedEvent(b, c) : d = !1) : this.forceShow || this.hideCursor();
                if (this.zooming) {
                    if (!isNaN(this.mouse2X)) {
                        isNaN(this.mouse2X0) || this.dispatchPanEvent();
                        return;
                    }
                    if (this.pan) {
                        this.dispatchPanEvent();
                        return;
                    }
                    (this.hZoomEnabled || this.vZoomEnabled) && this.zooming && this.updateSelection();
                }
                d && this.showCursor();
            }
        },
        updateDrawing: function() {
            this.drawing && this.chart.setMouseCursor("crosshair");
            this.drawingNow && (a.remove(this.drawingLine), this.drawingLine = a.line(this.container, [ this.drawStartX, this.mouseX ], [ this.drawStartY, this.mouseY ], this.cursorColor, 1, 1));
        },
        fixWidth: function(b) {
            if (this.fullWidth && this.prevLineWidth != b) {
                var c = this.vvLine, d = 0;
                c && (c.remove(), d = c.x);
                c = this.container.set();
                c.translate(d, 0);
                d = a.rect(this.container, b, this.height, this.cursorColor, this.cursorAlpha, 0);
                a.setCN(this.chart, d, "cursor-fill");
                d.translate(-b / 2, 0);
                c.push(d);
                this.vvLine = c;
                this.fullLines.push(c);
                this.prevLineWidth = b;
            }
        },
        fixHeight: function(b) {
            if (this.fullWidth && this.prevLineHeight != b) {
                var c = this.hhLine, d = 0;
                c && (c.remove(), d = c.y);
                c = this.container.set();
                c.translate(0, d);
                d = a.rect(this.container, this.width, b, this.cursorColor, this.cursorAlpha);
                d.translate(0, -b / 2);
                c.push(d);
                this.fullLines.push(c);
                this.hhLine = c;
                this.prevLineHeight = b;
            }
        },
        fixVLine: function(a, b) {
            if (!isNaN(a)) {
                if (isNaN(this.prevLineX)) {
                    var c = 0, d = this.mouseX;
                    if (this.limitToGraph) {
                        var e = this.chart.categoryAxis;
                        e && (this.chart.rotate || (c = "bottom" == e.position ? this.height : -this.height), 
                        d = a);
                    }
                    this.vvLine.translate(d, c);
                } else this.prevLineX != a && this.vvLine.translate(this.prevLineX, this.prevLineY);
                this.fx = a;
                this.prevLineX != a && (c = this.animationDuration, this.zooming && (c = 0), this.vvLine.stop(), 
                this.vvLine.animate({
                    translate: a + "," + b
                }, c, "easeOutSine"), this.prevLineX = a, this.prevLineY = b);
            }
        },
        fixHLine: function(a, b) {
            if (!isNaN(a)) {
                if (isNaN(this.prevLineY)) {
                    var c = 0, d = this.mouseY;
                    if (this.limitToGraph) {
                        var e = this.chart.categoryAxis;
                        e && (this.chart.rotate && (c = "right" == e.position ? this.width : -this.width), 
                        d = a);
                    }
                    this.hhLine.translate(c, d);
                } else this.prevLineY != a && this.hhLine.translate(this.prevLineX, this.prevLineY);
                this.fy = a;
                this.prevLineY != a && (c = this.animationDuration, this.zooming && (c = 0), this.hhLine.stop(), 
                this.hhLine.animate({
                    translate: b + "," + a
                }, c, "easeOutSine"), this.prevLineY = a, this.prevLineX = b);
            }
        },
        hideCursor: function(a) {
            this.forceShow = !1;
            this.chart.wasTouched && this.leaveAfterTouch || this.isHidden || this.leaveCursor || (this.hideLines(), 
            this.isHidden = !0, this.index = this.prevLineY = this.prevLineX = this.mouseY0 = this.mouseX0 = this.fy = this.fx = 0/0, 
            a ? this.chart.handleCursorHide() : this.fire({
                target: this,
                chart: this.chart,
                type: "onHideCursor"
            }), this.chart.setMouseCursor("auto"));
        },
        hideLines: function() {
            this.vvLine && this.vvLine.hide();
            this.hhLine && this.hhLine.hide();
            this.fullLines && this.fullLines.hide();
            this.isHidden = !0;
            this.chart.handleCursorHide();
        },
        showCursor: function(a) {
            !this.drawing && this.enabled && (this.vLineEnabled && this.vvLine && this.vvLine.show(), 
            this.hLineEnabled && this.hhLine && this.hhLine.show(), this.isHidden = !1, this.updateFullLine(), 
            a || this.fire({
                target: this,
                chart: this.chart,
                type: "onShowCursor"
            }), this.pan && this.chart.setMouseCursor("move"));
        },
        updateFullLine: function() {
            this.zooming && this.fullWidth && this.selection && (this.rotate ? 0 < this.selection.height && this.hhLine.hide() : 0 < this.selection.width && this.vvLine.hide());
        },
        updateSelection: function() {
            if (!this.pan && this.enabled) {
                var b = this.mouseX, c = this.mouseY;
                isNaN(this.fx) || (b = this.fx);
                isNaN(this.fy) || (c = this.fy);
                this.clearSelection();
                var d = this.mouseX0, e = this.mouseY0, f = this.width, g = this.height, b = a.fitToBounds(b, 0, f), c = a.fitToBounds(c, 0, g), h;
                b < d && (h = b, b = d, d = h);
                c < e && (h = c, c = e, e = h);
                this.hZoomEnabled ? f = b - d : d = 0;
                this.vZoomEnabled ? g = c - e : e = 0;
                isNaN(this.mouse2X) && 0 < Math.abs(f) && 0 < Math.abs(g) && (b = this.chart, c = a.rect(this.container, f, g, this.cursorColor, this.selectionAlpha), 
                a.setCN(b, c, "cursor-selection"), c.width = f, c.height = g, c.translate(d, e), 
                this.set.push(c), this.selection = c);
                this.updateFullLine();
            }
        },
        mouseIsOver: function() {
            var a = this.mouseX, b = this.mouseY;
            if (this.justReleased) return this.justReleased = !1, !0;
            if (this.mouseIsDown) return !0;
            if (!this.chart.mouseIsOver) return this.handleMouseOut(), !1;
            if (0 < a && a < this.width && 0 < b && b < this.height) return !0;
            this.handleMouseOut();
        },
        fixPosition: function() {
            this.prevY = this.prevX = 0/0;
        },
        handleMouseDown: function() {
            this.update();
            if (this.mouseIsOver()) if (this.mouseIsDown = !0, this.mouseX0 = this.mouseX, this.mouseY0 = this.mouseY, 
            this.mouse2X0 = this.mouse2X, this.mouse2Y0 = this.mouse2Y, this.drawing) this.drawStartY = this.mouseY, 
            this.drawStartX = this.mouseX, this.drawingNow = !0; else if (this.dispatchMovedEvent(this.mouseX, this.mouseY), 
            !this.pan && isNaN(this.mouse2X0) && (isNaN(this.fx) || (this.mouseX0 = this.fx), 
            isNaN(this.fy) || (this.mouseY0 = this.fy)), this.hZoomEnabled || this.vZoomEnabled) {
                this.zooming = !0;
                var a = {
                    chart: this.chart,
                    target: this,
                    type: "zoomStarted"
                };
                a.x = this.mouseX / this.width;
                a.y = this.mouseY / this.height;
                this.index0 = a.index = this.index;
                this.timestamp0 = this.timestamp;
                this.fire(a);
            }
        },
        registerInitialMouse: function() {},
        handleReleaseOutside: function() {
            this.mouseIsDown = !1;
            if (this.drawingNow) {
                this.drawingNow = !1;
                a.remove(this.drawingLine);
                var b = this.drawStartX, c = this.drawStartY, d = this.mouseX, e = this.mouseY, f = this.chart;
                (2 < Math.abs(b - d) || 2 < Math.abs(c - e)) && this.fire({
                    type: "draw",
                    target: this,
                    chart: f,
                    initialX: b,
                    initialY: c,
                    finalX: d,
                    finalY: e
                });
            }
            this.zooming && (this.zooming = !1, this.selectWithoutZooming ? this.dispatchZoomEvent("selected") : (this.hZoomEnabled || this.vZoomEnabled) && this.dispatchZoomEvent("zoomed"), 
            this.rolledOver && this.dispatchMovedEvent(this.mouseX, this.mouseY));
            this.mouse2Y0 = this.mouse2X0 = this.mouseY0 = this.mouseX0 = 0/0;
        },
        dispatchZoomEvent: function(a) {
            if (!this.pan) {
                var b = this.selection;
                if (b && 3 < Math.abs(b.width) && 3 < Math.abs(b.height)) {
                    var c = Math.min(this.index, this.index0), d = Math.max(this.index, this.index0), e = c, f = d, g = this.chart, h = g.chartData, i = g.categoryAxis;
                    i && i.parseDates && !i.equalSpacing && (e = h[c] ? h[c].time : Math.min(this.timestamp0, this.timestamp), 
                    f = h[d] ? g.getEndTime(h[d].time) : Math.max(this.timestamp0, this.timestamp));
                    var b = {
                        type: a,
                        chart: this.chart,
                        target: this,
                        end: f,
                        start: e,
                        startIndex: c,
                        endIndex: d,
                        selectionHeight: b.height,
                        selectionWidth: b.width,
                        selectionY: b.y,
                        selectionX: b.x
                    }, j;
                    this.hZoomEnabled && 4 < Math.abs(this.mouseX0 - this.mouseX) && (b.startX = this.mouseX0 / this.width, 
                    b.endX = this.mouseX / this.width, j = !0);
                    this.vZoomEnabled && 4 < Math.abs(this.mouseY0 - this.mouseY) && (b.startY = 1 - this.mouseY0 / this.height, 
                    b.endY = 1 - this.mouseY / this.height, j = !0);
                    j && (this.prevY = this.prevX = 0/0, this.fire(b), "selected" != a && this.clearSelection());
                    this.hideCursor();
                }
            }
        },
        dispatchMovedEvent: function(a, b, c, d) {
            a = Math.round(a);
            b = Math.round(b);
            if (!this.isHidden && (a != this.prevX || b != this.prevY || "changed" == c)) {
                c || (c = "moved");
                var e = this.fx, f = this.fy;
                isNaN(e) && (e = a);
                isNaN(f) && (f = b);
                var g = !1;
                this.zooming && this.pan && (g = !0);
                g = {
                    hidden: this.isHidden,
                    type: c,
                    chart: this.chart,
                    target: this,
                    x: a,
                    y: b,
                    finalX: e,
                    finalY: f,
                    zooming: this.zooming,
                    panning: g,
                    mostCloseGraph: this.mostCloseGraph,
                    index: this.index,
                    skip: d,
                    hideBalloons: this.hideGraphBalloons
                };
                this.rotate ? (g.position = b, g.finalPosition = f) : (g.position = a, g.finalPosition = e);
                this.prevX = a;
                this.prevY = b;
                d ? this.chart.handleCursorMove(g) : (this.fire(g), "changed" == c && this.chart.fire(g));
            }
        },
        dispatchPanEvent: function() {
            if (this.mouseIsDown) {
                var b = a.roundTo((this.mouseX - this.mouseX0) / this.width, 3), c = a.roundTo((this.mouseY - this.mouseY0) / this.height, 3), d = a.roundTo((this.mouse2X - this.mouse2X0) / this.width, 3), e = a.roundTo((this.mouse2Y - this.mouse2Y0) / this.height, 2), f = !1;
                0 !== Math.abs(b) && 0 !== Math.abs(c) && (f = !0);
                if (this.prevDeltaX == b || this.prevDeltaY == c) f = !1;
                isNaN(d) || isNaN(e) || (0 !== Math.abs(d) && 0 !== Math.abs(e) && (f = !0), this.prevDelta2X != d && this.prevDelta2Y != e) || (f = !1);
                f && (this.hideLines(), this.fire({
                    type: "panning",
                    chart: this.chart,
                    target: this,
                    deltaX: b,
                    deltaY: c,
                    delta2X: d,
                    delta2Y: e,
                    index: this.index
                }), this.prevDeltaX = b, this.prevDeltaY = c, this.prevDelta2X = d, this.prevDelta2Y = e);
            }
        },
        clearSelection: function() {
            var a = this.selection;
            a && (a.width = 0, a.height = 0, a.remove());
        },
        destroy: function() {
            this.clear();
            a.remove(this.selection);
            this.selection = null;
            clearTimeout(this.syncTO);
            a.remove(this.set);
        },
        clear: function() {},
        setTimestamp: function(a) {
            this.timestamp = a;
        },
        setIndex: function(a, b) {
            a != this.index && (this.index = a, b || this.isHidden || this.dispatchMovedEvent(this.mouseX, this.mouseY, "changed"));
        },
        handleMouseOut: function() {
            this.enabled && this.rolledOver && (this.leaveCursor || this.setIndex(void 0), this.forceShow = !1, 
            this.hideCursor(), this.rolledOver = !1);
        },
        showCursorAt: function(a) {
            var b = this.chart.categoryAxis;
            b && this.setPosition(b.categoryToCoordinate(a));
        },
        setPosition: function(a) {
            var b = this.chart, c = b.categoryAxis;
            if (c) {
                var d, e, f = c.coordinateToValue(a);
                c.showBalloonAt(f);
                this.forceShow = !0;
                c.stickBalloonToCategory ? b.rotate ? this.fixHLine(a, 0) : this.fixVLine(a, 0) : (this.showCursor(), 
                b.rotate ? this.hhLine.translate(0, a) : this.vvLine.translate(a, 0));
                b.rotate ? d = a : e = a;
                this.dispatchMovedEvent(e, d);
                b.rotate ? (this.vvLine && this.vvLine.hide(), this.hhLine && this.hhLine.show()) : (this.hhLine && this.hhLine.hide(), 
                this.vvLine && this.vvLine.show());
                this.updateFullLine();
                this.isHidden = !1;
                this.dispatchMovedEvent(e, d, "moved", !0);
            }
        },
        enableDrawing: function(a) {
            this.enabled = !a;
            this.hideCursor();
            this.drawing = a;
        },
        syncWithCursor: function(a, b) {
            clearTimeout(this.syncTO);
            a && (a.isHidden ? this.hideCursor(!0) : this.syncWithCursorReal(a, b));
        },
        isZooming: function(a) {
            this.zooming = a;
        },
        syncWithCursorReal: function(a, b) {
            var c = a.vvLine, d = a.hhLine;
            this.index = a.index;
            this.forceShow = !0;
            this.zooming && this.pan || this.showCursor(!0);
            this.hideGraphBalloons = b;
            this.justReleased = a.justReleased;
            this.zooming = a.zooming;
            this.index0 = a.index0;
            this.mouseX0 = a.mouseX0;
            this.mouseY0 = a.mouseY0;
            this.mouse2X0 = a.mouse2X0;
            this.mouse2Y0 = a.mouse2Y0;
            this.timestamp0 = a.timestamp0;
            this.prevDeltaX = a.prevDeltaX;
            this.prevDeltaY = a.prevDeltaY;
            this.prevDelta2X = a.prevDelta2X;
            this.prevDelta2Y = a.prevDelta2Y;
            this.fx = a.fx;
            this.fy = a.fy;
            this.index = a.index;
            a.zooming && this.updateSelection();
            var e = a.mouseX, f = a.mouseY;
            this.rotate ? (e = 0/0, this.vvLine && this.vvLine.hide(), this.hhLine && d && (isNaN(a.fy) ? this.hhLine.translate(0, a.mouseY) : this.fixHLine(a.fy, 0))) : (f = 0/0, 
            this.hhLine && this.hhLine.hide(), this.vvLine && c && (isNaN(a.fx) ? this.vvLine.translate(a.mouseX, 0) : this.fixVLine(a.fx, 0)));
            this.dispatchMovedEvent(e, f, "moved", !0);
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.SimpleChartScrollbar = a.Class({
        construct: function(b) {
            this.createEvents("zoomed", "zoomStarted", "zoomEnded");
            this.backgroundColor = "#D4D4D4";
            this.backgroundAlpha = 1;
            this.selectedBackgroundColor = "#EFEFEF";
            this.scrollDuration = this.selectedBackgroundAlpha = 1;
            this.resizeEnabled = !0;
            this.hideResizeGrips = !1;
            this.scrollbarHeight = 20;
            this.updateOnReleaseOnly = !1;
            9 > document.documentMode && (this.updateOnReleaseOnly = !0);
            this.dragIconHeight = this.dragIconWidth = 35;
            this.dragIcon = "dragIconRoundBig";
            this.dragCursorHover = "cursor: cursor: grab; cursor:-moz-grab; cursor:-webkit-grab;";
            this.dragCursorDown = "cursor: cursor: grab; cursor:-moz-grabbing; cursor:-webkit-grabbing;";
            this.enabled = !0;
            this.percentStart = this.offset = 0;
            this.percentEnd = 1;
            a.applyTheme(this, b, "SimpleChartScrollbar");
        },
        draw: function() {
            var b = this;
            b.destroy();
            if (b.enabled) {
                var c = b.chart.container, d = b.rotate, e = b.chart;
                e.panRequired = !0;
                var f = c.set();
                b.set = f;
                e.scrollbarsSet.push(f);
                var g, h;
                d ? (g = b.scrollbarHeight, h = e.plotAreaHeight) : (h = b.scrollbarHeight, g = e.plotAreaWidth);
                b.width = g;
                if ((b.height = h) && g) {
                    var i = a.rect(c, g, h, b.backgroundColor, b.backgroundAlpha, 1, b.backgroundColor, b.backgroundAlpha);
                    a.setCN(e, i, "scrollbar-bg");
                    b.bg = i;
                    f.push(i);
                    i = a.rect(c, g, h, "#000", .005);
                    f.push(i);
                    b.invisibleBg = i;
                    i.click(function() {
                        b.handleBgClick();
                    }).mouseover(function() {
                        b.handleMouseOver();
                    }).mouseout(function() {
                        b.handleMouseOut();
                    }).touchend(function() {
                        b.handleBgClick();
                    });
                    i = a.rect(c, g, h, b.selectedBackgroundColor, b.selectedBackgroundAlpha);
                    a.setCN(e, i, "scrollbar-bg-selected");
                    b.selectedBG = i;
                    f.push(i);
                    g = a.rect(c, g, h, "#000", .005);
                    b.dragger = g;
                    f.push(g);
                    g.mousedown(function(a) {
                        b.handleDragStart(a);
                    }).mouseup(function() {
                        b.handleDragStop();
                    }).mouseover(function() {
                        b.handleDraggerOver();
                    }).mouseout(function() {
                        b.handleMouseOut();
                    }).touchstart(function(a) {
                        b.handleDragStart(a);
                    }).touchend(function() {
                        b.handleDragStop();
                    });
                    g = e.pathToImages;
                    h = b.dragIcon.replace(/\.[a-z]*$/i, "");
                    d ? (i = g + h + "H" + e.extension, g = b.dragIconWidth, d = b.dragIconHeight) : (i = g + h + e.extension, 
                    d = b.dragIconWidth, g = b.dragIconHeight);
                    h = c.image(i, 0, 0, d, g);
                    a.setCN(e, h, "scrollbar-grip-left");
                    i = c.image(i, 0, 0, d, g);
                    a.setCN(e, i, "scrollbar-grip-right");
                    var j = 10, k = 20;
                    e.panEventsEnabled && (j = 25, k = b.scrollbarHeight);
                    var l = a.rect(c, j, k, "#000", .005), m = a.rect(c, j, k, "#000", .005);
                    m.translate(-(j - d) / 2, -(k - g) / 2);
                    l.translate(-(j - d) / 2, -(k - g) / 2);
                    d = c.set([ h, m ]);
                    c = c.set([ i, l ]);
                    b.iconLeft = d;
                    f.push(b.iconLeft);
                    b.iconRight = c;
                    f.push(c);
                    d.mousedown(function() {
                        b.leftDragStart();
                    }).mouseup(function() {
                        b.leftDragStop();
                    }).mouseover(function() {
                        b.iconRollOver();
                    }).mouseout(function() {
                        b.iconRollOut();
                    }).touchstart(function() {
                        b.leftDragStart();
                    }).touchend(function() {
                        b.leftDragStop();
                    });
                    c.mousedown(function() {
                        b.rightDragStart();
                    }).mouseup(function() {
                        b.rightDragStop();
                    }).mouseover(function() {
                        b.iconRollOver();
                    }).mouseout(function() {
                        b.iconRollOut();
                    }).touchstart(function() {
                        b.rightDragStart();
                    }).touchend(function() {
                        b.rightDragStop();
                    });
                    a.ifArray(e.chartData) ? f.show() : f.hide();
                    b.hideDragIcons();
                    b.clipDragger(!1);
                }
                f.translate(b.x, b.y);
                f.node.style.msTouchAction = "none";
                f.node.style.touchAction = "none";
            }
        },
        updateScrollbarSize: function(a, b) {
            if (!isNaN(a) && !isNaN(b)) {
                a = Math.round(a);
                b = Math.round(b);
                var c = this.dragger, d, e, f, g, h;
                this.rotate ? (d = 0, e = a, f = this.width + 1, g = b - a, c.setAttr("height", b - a), 
                c.setAttr("y", e)) : (d = a, e = 0, f = b - a, g = this.height + 1, h = b - a, c.setAttr("x", d), 
                c.setAttr("width", h));
                this.clipAndUpdate(d, e, f, g);
            }
        },
        update: function() {
            var a, b = !1, c, d, e = this.x, f = this.y, g = this.dragger, h = this.getDBox();
            if (h) {
                c = h.x + e;
                d = h.y + f;
                var i = h.width, h = h.height, j = this.rotate, k = this.chart, l = this.width, m = this.height, n = k.mouseX, o = k.mouseY;
                a = this.initialMouse;
                this.forceClip && this.clipDragger(!0);
                if (k.mouseIsOver) {
                    this.dragging && (k = this.initialCoord, j ? (a = k + (o - a), 0 > a && (a = 0), 
                    k = m - h, a > k && (a = k), g.setAttr("y", a)) : (a = k + (n - a), 0 > a && (a = 0), 
                    k = l - i, a > k && (a = k), g.setAttr("x", a)), this.clipDragger(!0));
                    if (this.resizingRight) {
                        if (j) if (a = o - d, a + d > m + f && (a = m - d + f), 0 > a) this.resizingRight = !1, 
                        b = this.resizingLeft = !0; else {
                            if (0 === a || isNaN(a)) a = .1;
                            g.setAttr("height", a);
                        } else if (a = n - c, a + c > l + e && (a = l - c + e), 0 > a) this.resizingRight = !1, 
                        b = this.resizingLeft = !0; else {
                            if (0 === a || isNaN(a)) a = .1;
                            g.setAttr("width", a);
                        }
                        this.clipDragger(!0);
                    }
                    if (this.resizingLeft) {
                        if (j) if (c = d, d = o, d < f && (d = f), isNaN(d) && (d = f), d > m + f && (d = m + f), 
                        a = !0 === b ? c - d : h + c - d, 0 > a) this.resizingRight = !0, this.resizingLeft = !1, 
                        g.setAttr("y", c + h - f); else {
                            if (0 === a || isNaN(a)) a = .1;
                            g.setAttr("y", d - f);
                            g.setAttr("height", a);
                        } else if (d = n, d < e && (d = e), isNaN(d) && (d = e), d > l + e && (d = l + e), 
                        a = !0 === b ? c - d : i + c - d, 0 > a) this.resizingRight = !0, this.resizingLeft = !1, 
                        g.setAttr("x", c + i - e); else {
                            if (0 === a || isNaN(a)) a = .1;
                            g.setAttr("x", d - e);
                            g.setAttr("width", a);
                        }
                        this.clipDragger(!0);
                    }
                }
            }
        },
        stopForceClip: function() {
            this.animating = this.forceClip = !1;
        },
        clipDragger: function(a) {
            var b = this.getDBox();
            if (b) {
                var c = b.x, d = b.y, e = b.width, b = b.height, f = !1;
                if (this.rotate) {
                    if (c = 0, e = this.width + 1, this.clipY != d || this.clipH != b) f = !0;
                } else if (d = 0, b = this.height + 1, this.clipX != c || this.clipW != e) f = !0;
                f && (this.clipAndUpdate(c, d, e, b), a && (this.updateOnReleaseOnly || this.dispatchScrollbarEvent()));
            }
        },
        maskGraphs: function() {},
        clipAndUpdate: function(a, b, c, d) {
            this.clipX = a;
            this.clipY = b;
            this.clipW = c;
            this.clipH = d;
            this.selectedBG.setAttr("width", c);
            this.selectedBG.setAttr("height", d);
            this.selectedBG.translate(a, b);
            this.updateDragIconPositions();
            this.maskGraphs(a, b, c, d);
        },
        dispatchScrollbarEvent: function() {
            if (this.skipEvent) this.skipEvent = !1; else {
                var a = this.chart;
                a.hideBalloon();
                var b = this.getDBox(), c = b.x, d = b.y, e = b.width, f = b.height, g, h;
                this.rotate ? (b = d, g = this.height / f, h = 1 - d / this.height, c = 1 - (d + f) / this.height) : (b = c, 
                g = this.width / e, h = c / this.width, c = (c + e) / this.width);
                this.fire({
                    type: "zoomed",
                    position: b,
                    chart: a,
                    target: this,
                    multiplier: g,
                    relativeStart: c,
                    relativeEnd: h
                });
            }
        },
        updateDragIconPositions: function() {
            var a = this.getDBox(), b = a.x, c = a.y, d = this.iconLeft, e = this.iconRight, f, g, h = this.scrollbarHeight;
            this.rotate ? (f = this.dragIconWidth, g = this.dragIconHeight, d.translate((h - g) / 2, c - f / 2), 
            e.translate((h - g) / 2, c + a.height - f / 2)) : (f = this.dragIconHeight, g = this.dragIconWidth, 
            d.translate(b - g / 2, (h - f) / 2), e.translate(b - g / 2 + a.width, (h - f) / 2));
        },
        showDragIcons: function() {
            this.resizeEnabled && (this.iconLeft.show(), this.iconRight.show());
        },
        hideDragIcons: function() {
            if (!this.resizingLeft && !this.resizingRight && !this.dragging) {
                if (this.hideResizeGrips || !this.resizeEnabled) this.iconLeft.hide(), this.iconRight.hide();
                this.removeCursors();
            }
        },
        removeCursors: function() {
            this.chart.setMouseCursor("auto");
        },
        fireZoomEvent: function(a) {
            this.fire({
                type: a,
                chart: this.chart,
                target: this
            });
        },
        percentZoom: function(a, b) {
            if (this.dragger && this.enabled) {
                this.dragger.stop();
                isNaN(a) && (a = 0);
                isNaN(b) && (b = 1);
                var c, d, e;
                this.rotate ? (c = this.height, d = c - c * b, e = c - c * a) : (c = this.width, 
                e = c * b, d = c * a);
                this.updateScrollbarSize(d, e);
                this.clipDragger(!1);
                this.percentStart = a;
                this.percentEnd = b;
            }
        },
        destroy: function() {
            this.clear();
            a.remove(this.set);
            a.remove(this.iconRight);
            a.remove(this.iconLeft);
        },
        clear: function() {},
        handleDragStart: function() {
            if (this.enabled) {
                this.fireZoomEvent("zoomStarted");
                var b = this.chart;
                this.dragger.stop();
                this.removeCursors();
                a.isModern && this.dragger.node.setAttribute("style", this.dragCursorDown);
                this.dragging = !0;
                var c = this.getDBox();
                this.rotate ? (this.initialCoord = c.y, this.initialMouse = b.mouseY) : (this.initialCoord = c.x, 
                this.initialMouse = b.mouseX);
            }
        },
        handleDragStop: function() {
            this.updateOnReleaseOnly && (this.update(), this.skipEvent = !1, this.dispatchScrollbarEvent());
            this.dragging = !1;
            this.mouseIsOver && this.removeCursors();
            a.isModern && this.dragger.node.setAttribute("style", this.dragCursorHover);
            this.update();
            this.fireZoomEvent("zoomEnded");
        },
        handleDraggerOver: function() {
            this.handleMouseOver();
            a.isModern && this.dragger.node.setAttribute("style", this.dragCursorHover);
        },
        leftDragStart: function() {
            this.fireZoomEvent("zoomStarted");
            this.dragger.stop();
            this.resizingLeft = !0;
        },
        leftDragStop: function() {
            this.resizingLeft = !1;
            this.mouseIsOver || this.removeCursors();
            this.updateOnRelease();
            this.fireZoomEvent("zoomEnded");
        },
        rightDragStart: function() {
            this.fireZoomEvent("zoomStarted");
            this.dragger.stop();
            this.resizingRight = !0;
        },
        rightDragStop: function() {
            this.resizingRight = !1;
            this.mouseIsOver || this.removeCursors();
            this.updateOnRelease();
            this.fireZoomEvent("zoomEnded");
        },
        iconRollOut: function() {
            this.removeCursors();
        },
        iconRollOver: function() {
            this.rotate ? this.chart.setMouseCursor("ns-resize") : this.chart.setMouseCursor("ew-resize");
            this.handleMouseOver();
        },
        getDBox: function() {
            if (this.dragger) return this.dragger.getBBox();
        },
        handleBgClick: function() {
            var b = this;
            if (!b.resizingRight && !b.resizingLeft) {
                b.zooming = !0;
                var c, d, e = b.scrollDuration, f = b.dragger;
                c = b.getDBox();
                var g = c.height, h = c.width;
                d = b.chart;
                var i = b.y, j = b.x, k = b.rotate;
                k ? (c = "y", d = d.mouseY - g / 2 - i, d = a.fitToBounds(d, 0, b.height - g)) : (c = "x", 
                d = d.mouseX - h / 2 - j, d = a.fitToBounds(d, 0, b.width - h));
                b.updateOnReleaseOnly ? (b.skipEvent = !1, f.setAttr(c, d), b.dispatchScrollbarEvent(), 
                b.clipDragger()) : (b.animating = !0, d = Math.round(d), k ? f.animate({
                    y: d
                }, e, ">") : f.animate({
                    x: d
                }, e, ">"), b.forceClip = !0, clearTimeout(b.forceTO), b.forceTO = setTimeout(function() {
                    b.stopForceClip.call(b);
                }, 5e3 * e));
            }
        },
        updateOnRelease: function() {
            this.updateOnReleaseOnly && (this.update(), this.skipEvent = !1, this.dispatchScrollbarEvent());
        },
        handleReleaseOutside: function() {
            if (this.set) {
                if (this.resizingLeft || this.resizingRight || this.dragging) this.updateOnRelease(), 
                this.removeCursors();
                this.animating = this.mouseIsOver = this.dragging = this.resizingRight = this.resizingLeft = !1;
                this.hideDragIcons();
                this.update();
            }
        },
        handleMouseOver: function() {
            this.mouseIsOver = !0;
            this.showDragIcons();
        },
        handleMouseOut: function() {
            this.mouseIsOver = !1;
            this.hideDragIcons();
            this.removeCursors();
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.ChartScrollbar = a.Class({
        inherits: a.SimpleChartScrollbar,
        construct: function(b) {
            this.cname = "ChartScrollbar";
            a.ChartScrollbar.base.construct.call(this, b);
            this.graphLineColor = "#BBBBBB";
            this.graphLineAlpha = 0;
            this.graphFillColor = "#BBBBBB";
            this.graphFillAlpha = 1;
            this.selectedGraphLineColor = "#888888";
            this.selectedGraphLineAlpha = 0;
            this.selectedGraphFillColor = "#888888";
            this.selectedGraphFillAlpha = 1;
            this.gridCount = 0;
            this.gridColor = "#FFFFFF";
            this.gridAlpha = .7;
            this.skipEvent = this.autoGridCount = !1;
            this.color = "#FFFFFF";
            this.scrollbarCreated = !1;
            this.oppositeAxis = !0;
            a.applyTheme(this, b, this.cname);
        },
        init: function() {
            var b = this.categoryAxis, c = this.chart, d = this.gridAxis;
            b || ("CategoryAxis" == this.gridAxis.cname ? (this.catScrollbar = !0, b = new a.CategoryAxis(), 
            b.id = "scrollbar") : (b = new a.ValueAxis(), b.data = c.chartData, b.id = d.id, 
            b.type = d.type, b.maximumDate = d.maximumDate, b.minimumDate = d.minimumDate, b.minPeriod = d.minPeriod), 
            this.categoryAxis = b);
            b.chart = c;
            b.dateFormats = d.dateFormats;
            b.markPeriodChange = d.markPeriodChange;
            b.boldPeriodBeginning = d.boldPeriodBeginning;
            b.labelFunction = d.labelFunction;
            b.axisItemRenderer = a.RecItem;
            b.axisRenderer = a.RecAxis;
            b.guideFillRenderer = a.RecFill;
            b.inside = !0;
            b.fontSize = this.fontSize;
            b.tickLength = 0;
            b.axisAlpha = 0;
            a.isString(this.graph) && (this.graph = a.getObjById(c.graphs, this.graph));
            (b = this.graph) && this.catScrollbar && (d = this.valueAxis, d || (this.valueAxis = d = new a.ValueAxis(), 
            d.visible = !1, d.scrollbar = !0, d.axisItemRenderer = a.RecItem, d.axisRenderer = a.RecAxis, 
            d.guideFillRenderer = a.RecFill, d.labelsEnabled = !1, d.chart = c), c = this.unselectedGraph, 
            c || (c = new a.AmGraph(), c.scrollbar = !0, this.unselectedGraph = c, c.negativeBase = b.negativeBase, 
            c.noStepRisers = b.noStepRisers), c = this.selectedGraph, c || (c = new a.AmGraph(), 
            c.scrollbar = !0, this.selectedGraph = c, c.negativeBase = b.negativeBase, c.noStepRisers = b.noStepRisers));
            this.scrollbarCreated = !0;
        },
        draw: function() {
            var b = this;
            a.ChartScrollbar.base.draw.call(b);
            if (b.enabled) {
                b.scrollbarCreated || b.init();
                var c = b.chart, d = c.chartData, e = b.categoryAxis, f = b.rotate, g = b.x, h = b.y, i = b.width, j = b.height, k = b.gridAxis, l = b.set;
                e.setOrientation(!f);
                e.parseDates = k.parseDates;
                "ValueAxis" == b.categoryAxis.cname && (e.rotate = !f);
                e.equalSpacing = k.equalSpacing;
                e.minPeriod = k.minPeriod;
                e.startOnAxis = k.startOnAxis;
                e.width = i - 1;
                e.height = j;
                e.gridCount = b.gridCount;
                e.gridColor = b.gridColor;
                e.gridAlpha = b.gridAlpha;
                e.color = b.color;
                e.tickLength = 0;
                e.axisAlpha = 0;
                e.autoGridCount = b.autoGridCount;
                e.parseDates && !e.equalSpacing && e.timeZoom(c.firstTime, c.lastTime);
                e.minimum = b.gridAxis.fullMin;
                e.maximum = b.gridAxis.fullMax;
                e.strictMinMax = !0;
                e.zoom(0, d.length - 1);
                if ((k = b.graph) && b.catScrollbar) {
                    var m = b.valueAxis, n = k.valueAxis;
                    m.id = n.id;
                    m.rotate = f;
                    m.setOrientation(f);
                    m.width = i;
                    m.height = j;
                    m.dataProvider = d;
                    m.reversed = n.reversed;
                    m.logarithmic = n.logarithmic;
                    m.gridAlpha = 0;
                    m.axisAlpha = 0;
                    l.push(m.set);
                    f ? (m.y = h, m.x = 0) : (m.x = g, m.y = 0);
                    var g = 1/0, h = -1/0, o;
                    for (o = 0; o < d.length; o++) {
                        var p = d[o].axes[n.id].graphs[k.id].values, q;
                        for (q in p) if (p.hasOwnProperty(q) && "percents" != q && "total" != q) {
                            var r = p[q];
                            r < g && (g = r);
                            r > h && (h = r);
                        }
                    }
                    1/0 != g && (m.minimum = g);
                    -1/0 != h && (m.maximum = h + .1 * (h - g));
                    g == h && (--m.minimum, m.maximum += 1);
                    void 0 !== b.minimum && (m.minimum = b.minimum);
                    void 0 !== b.maximum && (m.maximum = b.maximum);
                    m.zoom(0, d.length - 1);
                    q = b.unselectedGraph;
                    q.id = k.id;
                    q.bcn = "scrollbar-graph-";
                    q.rotate = f;
                    q.chart = c;
                    q.data = d;
                    q.valueAxis = m;
                    q.chart = k.chart;
                    q.categoryAxis = b.categoryAxis;
                    q.periodSpan = k.periodSpan;
                    q.valueField = k.valueField;
                    q.openField = k.openField;
                    q.closeField = k.closeField;
                    q.highField = k.highField;
                    q.lowField = k.lowField;
                    q.lineAlpha = b.graphLineAlpha;
                    q.lineColorR = b.graphLineColor;
                    q.fillAlphas = b.graphFillAlpha;
                    q.fillColorsR = b.graphFillColor;
                    q.connect = k.connect;
                    q.hidden = k.hidden;
                    q.width = i;
                    q.height = j;
                    q.pointPosition = k.pointPosition;
                    q.stepDirection = k.stepDirection;
                    q.periodSpan = k.periodSpan;
                    n = b.selectedGraph;
                    n.id = k.id;
                    n.bcn = q.bcn + "selected-";
                    n.rotate = f;
                    n.chart = c;
                    n.data = d;
                    n.valueAxis = m;
                    n.chart = k.chart;
                    n.categoryAxis = e;
                    n.periodSpan = k.periodSpan;
                    n.valueField = k.valueField;
                    n.openField = k.openField;
                    n.closeField = k.closeField;
                    n.highField = k.highField;
                    n.lowField = k.lowField;
                    n.lineAlpha = b.selectedGraphLineAlpha;
                    n.lineColorR = b.selectedGraphLineColor;
                    n.fillAlphas = b.selectedGraphFillAlpha;
                    n.fillColorsR = b.selectedGraphFillColor;
                    n.connect = k.connect;
                    n.hidden = k.hidden;
                    n.width = i;
                    n.height = j;
                    n.pointPosition = k.pointPosition;
                    n.stepDirection = k.stepDirection;
                    n.periodSpan = k.periodSpan;
                    c = b.graphType;
                    c || (c = k.type);
                    q.type = c;
                    n.type = c;
                    d = d.length - 1;
                    q.zoom(0, d);
                    n.zoom(0, d);
                    n.set.click(function() {
                        b.handleBackgroundClick();
                    }).mouseover(function() {
                        b.handleMouseOver();
                    }).mouseout(function() {
                        b.handleMouseOut();
                    });
                    q.set.click(function() {
                        b.handleBackgroundClick();
                    }).mouseover(function() {
                        b.handleMouseOver();
                    }).mouseout(function() {
                        b.handleMouseOut();
                    });
                    l.push(q.set);
                    l.push(n.set);
                }
                l.push(e.set);
                l.push(e.labelsSet);
                b.bg.toBack();
                b.invisibleBg.toFront();
                b.dragger.toFront();
                b.iconLeft.toFront();
                b.iconRight.toFront();
            }
        },
        timeZoom: function(b, c, d) {
            this.startTime = b;
            this.endTime = c;
            this.timeDifference = c - b;
            this.skipEvent = !a.toBoolean(d);
            this.zoomScrollbar();
            this.dispatchScrollbarEvent();
        },
        zoom: function(a, b) {
            this.start = a;
            this.end = b;
            this.skipEvent = !0;
            this.zoomScrollbar();
        },
        dispatchScrollbarEvent: function() {
            if (this.categoryAxis && "ValueAxis" == this.categoryAxis.cname) a.ChartScrollbar.base.dispatchScrollbarEvent.call(this); else if (this.skipEvent) this.skipEvent = !1; else {
                var b = this.chart.chartData, c, d, e = this.dragger.getBBox();
                c = e.x;
                var f = e.y, g = e.width, e = e.height, h = this.chart;
                this.rotate ? (c = f, d = e) : d = g;
                g = {
                    type: "zoomed",
                    target: this
                };
                g.chart = h;
                var i = this.categoryAxis, j = this.stepWidth, f = h.minSelectedTime, e = h.maxSelectedTime, k = !1;
                if (i.parseDates && !i.equalSpacing) {
                    if (b = h.lastTime, h = h.firstTime, i = Math.round(c / j) + h, c = this.dragging ? i + this.timeDifference : Math.round((c + d) / j) + h, 
                    i > c && (i = c), 0 < f && c - i < f && (c = Math.round(i + (c - i) / 2), k = Math.round(f / 2), 
                    i = c - k, c += k, k = !0), 0 < e && c - i > e && (c = Math.round(i + (c - i) / 2), 
                    k = Math.round(e / 2), i = c - k, c += k, k = !0), c > b && (c = b), c - f < i && (i = c - f), 
                    i < h && (i = h), i + f > c && (c = i + f), i != this.startTime || c != this.endTime) this.startTime = i, 
                    this.endTime = c, g.start = i, g.end = c, g.startDate = new Date(i), g.endDate = new Date(c), 
                    this.fire(g);
                } else if (i.startOnAxis || (c += j / 2), d -= this.stepWidth / 2, f = i.xToIndex(c), 
                c = i.xToIndex(c + d), f != this.start || this.end != c) i.startOnAxis && (this.resizingRight && f == c && c++, 
                this.resizingLeft && f == c && (0 < f ? f-- : c = 1)), this.start = f, this.end = this.dragging ? this.start + this.difference : c, 
                g.start = this.start, g.end = this.end, i.parseDates && (b[this.start] && (g.startDate = new Date(b[this.start].time)), 
                b[this.end] && (g.endDate = new Date(b[this.end].time))), this.fire(g);
                k && this.zoomScrollbar(!0);
            }
        },
        zoomScrollbar: function(a) {
            if ((!(this.dragging || this.resizingLeft || this.resizingRight || this.animating) || a) && this.dragger && this.enabled) {
                var b;
                a = this.chart;
                var c = a.chartData, d = this.categoryAxis;
                d.parseDates && !d.equalSpacing ? (c = d.stepWidth, d = a.firstTime, a = c * (this.startTime - d), 
                b = c * (this.endTime - d)) : (a = c[this.start].x[d.id], b = c[this.end].x[d.id], 
                c = d.stepWidth, d.startOnAxis || (d = c / 2, a -= d, b += d));
                this.stepWidth = c;
                this.updateScrollbarSize(a, b);
            }
        },
        maskGraphs: function(a, b, c, d) {
            var e = this.selectedGraph;
            e && e.set.clipRect(a, b, c, d);
        },
        handleDragStart: function() {
            a.ChartScrollbar.base.handleDragStart.call(this);
            this.difference = this.end - this.start;
            this.timeDifference = this.endTime - this.startTime;
            0 > this.timeDifference && (this.timeDifference = 0);
        },
        handleBackgroundClick: function() {
            a.ChartScrollbar.base.handleBackgroundClick.call(this);
            this.dragging || (this.difference = this.end - this.start, this.timeDifference = this.endTime - this.startTime, 
            0 > this.timeDifference && (this.timeDifference = 0));
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.AmBalloon = a.Class({
        construct: function(b) {
            this.cname = "AmBalloon";
            this.enabled = !0;
            this.fillColor = "#FFFFFF";
            this.fillAlpha = .8;
            this.borderThickness = 2;
            this.borderColor = "#FFFFFF";
            this.borderAlpha = 1;
            this.cornerRadius = 0;
            this.maxWidth = 220;
            this.horizontalPadding = 8;
            this.verticalPadding = 4;
            this.pointerWidth = 6;
            this.pointerOrientation = "V";
            this.color = "#000000";
            this.adjustBorderColor = !0;
            this.show = this.follow = this.showBullet = !1;
            this.bulletSize = 3;
            this.shadowAlpha = .4;
            this.shadowColor = "#000000";
            this.fadeOutDuration = this.animationDuration = .3;
            this.fixedPosition = !0;
            this.offsetY = 6;
            this.offsetX = 1;
            this.textAlign = "center";
            this.disableMouseEvents = !0;
            this.deltaSignX = this.deltaSignY = 1;
            a.isModern || (this.offsetY *= 1.5);
            this.sdy = this.sdx = 0;
            a.applyTheme(this, b, this.cname);
        },
        draw: function() {
            var b = this.pointToX, c = this.pointToY;
            a.isModern || (this.drop = !1);
            var d = this.chart;
            a.VML && (this.fadeOutDuration = 0);
            this.xAnim && d.stopAnim(this.xAnim);
            this.yAnim && d.stopAnim(this.yAnim);
            this.sdy = this.sdx = 0;
            if (!isNaN(b)) {
                var e = this.follow, f = d.container, g = this.set;
                a.remove(g);
                this.removeDiv();
                g = f.set();
                g.node.style.pointerEvents = "none";
                this.set = g;
                this.mainSet ? (this.mainSet.push(this.set), this.sdx = this.mainSet.x, this.sdy = this.mainSet.y) : d.balloonsSet.push(g);
                if (this.show) {
                    var h = this.l, i = this.t, j = this.r, k = this.b, l = this.balloonColor, m = this.fillColor, n = this.borderColor, o = m;
                    void 0 != l && (this.adjustBorderColor ? o = n = l : m = l);
                    var p = this.horizontalPadding, q = this.verticalPadding, r = this.pointerWidth, s = this.pointerOrientation, t = this.cornerRadius, u = d.fontFamily, v = this.fontSize;
                    void 0 == v && (v = d.fontSize);
                    var l = document.createElement("div"), w = d.classNamePrefix;
                    l.className = w + "-balloon-div";
                    this.className && (l.className = l.className + " " + w + "-balloon-div-" + this.className);
                    w = l.style;
                    this.disableMouseEvents && (w.pointerEvents = "none");
                    w.position = "absolute";
                    var x = this.minWidth, y = "";
                    isNaN(x) || (y = "min-width:" + (x - 2 * p) + "px; ");
                    l.innerHTML = '<div style="text-align:' + this.textAlign + "; " + y + "max-width:" + this.maxWidth + "px; font-size:" + v + "px; color:" + this.color + "; font-family:" + u + '">' + this.text + "</div>";
                    d.chartDiv.appendChild(l);
                    this.textDiv = l;
                    var z = l.offsetWidth, A = l.offsetHeight;
                    l.clientHeight && (z = l.clientWidth, A = l.clientHeight);
                    u = A + 2 * q;
                    y = z + 2 * p;
                    !isNaN(x) && y < x && (y = x);
                    window.opera && (u += 2);
                    var B = !1, v = this.offsetY;
                    d.handDrawn && (v += d.handDrawScatter + 2);
                    "H" != s ? (x = b - y / 2, c < i + u + 10 && "down" != s ? (B = !0, e && (c += v), 
                    v = c + r, this.deltaSignY = -1) : (e && (c -= v), v = c - u - r, this.deltaSignY = 1)) : (2 * r > u && (r = u / 2), 
                    v = c - u / 2, b < h + (j - h) / 2 ? (x = b + r, this.deltaSignX = -1) : (x = b - y - r, 
                    this.deltaSignX = 1));
                    v + u >= k && (v = k - u);
                    v < i && (v = i);
                    x < h && (x = h);
                    x + y > j && (x = j - y);
                    var i = v + q, k = x + p, C = this.shadowAlpha, D = this.shadowColor, p = this.borderThickness, E = this.bulletSize, F, q = this.fillAlpha, G = this.borderAlpha;
                    this.showBullet && (F = a.circle(f, E, o, q), g.push(F));
                    this.drop ? (h = y / 1.6, j = 0, "V" == s && (s = "down"), "H" == s && (s = "left"), 
                    "down" == s && (x = b + 1, v = c - h - h / 3), "up" == s && (j = 180, x = b + 1, 
                    v = c + h + h / 3), "left" == s && (j = 270, x = b + h + h / 3 + 2, v = c), "right" == s && (j = 90, 
                    x = b - h - h / 3 + 2, v = c), i = v - A / 2 + 1, k = x - z / 2 - 1, m = a.drop(f, h, j, m, q, p, n, G)) : 0 < t || 0 === r ? (0 < C && (b = a.rect(f, y, u, m, 0, p + 1, D, C, t), 
                    a.isModern ? b.translate(1, 1) : b.translate(4, 4), g.push(b)), m = a.rect(f, y, u, m, q, p, n, G, t)) : (o = [], 
                    t = [], "H" != s ? (h = b - x, h > y - r && (h = y - r), h < r && (h = r), o = [ 0, h - r, b - x, h + r, y, y, 0, 0 ], 
                    t = B ? [ 0, 0, c - v, 0, 0, u, u, 0 ] : [ u, u, c - v, u, u, 0, 0, u ]) : (s = c - v, 
                    s > u - r && (s = u - r), s < r && (s = r), t = [ 0, s - r, c - v, s + r, u, u, 0, 0 ], 
                    o = b < h + (j - h) / 2 ? [ 0, 0, x < b ? 0 : b - x, 0, 0, y, y, 0 ] : [ y, y, x + y > b ? y : b - x, y, y, 0, 0, y ]), 
                    0 < C && (b = a.polygon(f, o, t, m, 0, p, D, C), b.translate(1, 1), g.push(b)), 
                    m = a.polygon(f, o, t, m, q, p, n, G));
                    this.bg = m;
                    g.push(m);
                    m.toFront();
                    a.setCN(d, m, "balloon-bg");
                    this.className && a.setCN(d, m, "balloon-bg-" + this.className);
                    f = 1 * this.deltaSignX;
                    k += this.sdx;
                    i += this.sdy;
                    w.left = k + "px";
                    w.top = i + "px";
                    g.translate(x - f, v, 1, !0);
                    m = m.getBBox();
                    this.bottom = v + u + 1;
                    this.yPos = m.y + v;
                    F && F.translate(this.pointToX - x + f, c - v);
                    c = this.animationDuration;
                    0 < this.animationDuration && !e && !isNaN(this.prevX) && (g.translate(this.prevX, this.prevY, 0/0, !0), 
                    g.animate({
                        translate: x - f + "," + v
                    }, c, "easeOutSine"), l && (w.left = this.prevTX + "px", w.top = this.prevTY + "px", 
                    this.xAnim = d.animate({
                        node: l
                    }, "left", this.prevTX, k, c, "easeOutSine", "px"), this.yAnim = d.animate({
                        node: l
                    }, "top", this.prevTY, i, c, "easeOutSine", "px")));
                    this.prevX = x - f;
                    this.prevY = v;
                    this.prevTX = k;
                    this.prevTY = i;
                }
            }
        },
        fixPrevious: function() {
            this.rPrevX = this.prevX;
            this.rPrevY = this.prevY;
            this.rPrevTX = this.prevTX;
            this.rPrevTY = this.prevTY;
        },
        restorePrevious: function() {
            this.prevX = this.rPrevX;
            this.prevY = this.rPrevY;
            this.prevTX = this.rPrevTX;
            this.prevTY = this.rPrevTY;
        },
        followMouse: function() {
            if (this.follow && this.show) {
                var a = this.chart.mouseX - this.offsetX * this.deltaSignX - this.sdx, b = this.chart.mouseY - this.sdy;
                this.pointToX = a;
                this.pointToY = b;
                if (a != this.previousX || b != this.previousY) if (this.previousX = a, this.previousY = b, 
                0 === this.cornerRadius) this.draw(); else {
                    var c = this.set;
                    if (c) {
                        var d = c.getBBox(), a = a - d.width / 2, e = b - d.height - 10;
                        a < this.l && (a = this.l);
                        a > this.r - d.width && (a = this.r - d.width);
                        e < this.t && (e = b + 10);
                        c.translate(a, e);
                        b = this.textDiv.style;
                        b.left = a + this.horizontalPadding + "px";
                        b.top = e + this.verticalPadding + "px";
                    }
                }
            }
        },
        changeColor: function(a) {
            this.balloonColor = a;
        },
        setBounds: function(a, b, c, d) {
            this.l = a;
            this.t = b;
            this.r = c;
            this.b = d;
            this.destroyTO && clearTimeout(this.destroyTO);
        },
        showBalloon: function(a) {
            if (this.text != a || this.positionChanged) this.text = a, this.isHiding = !1, this.show = !0, 
            this.destroyTO && clearTimeout(this.destroyTO), a = this.chart, this.fadeAnim1 && a.stopAnim(this.fadeAnim1), 
            this.fadeAnim2 && a.stopAnim(this.fadeAnim2), this.draw(), this.positionChanged = !1;
        },
        hide: function(a) {
            var b = this;
            b.text = void 0;
            isNaN(a) && (a = b.fadeOutDuration);
            var c = b.chart;
            if (0 < a && !b.isHiding) {
                b.isHiding = !0;
                b.destroyTO && clearTimeout(b.destroyTO);
                b.destroyTO = setTimeout(function() {
                    b.destroy.call(b);
                }, 1e3 * a);
                b.follow = !1;
                b.show = !1;
                var d = b.set;
                d && (d.setAttr("opacity", b.fillAlpha), b.fadeAnim1 = d.animate({
                    opacity: 0
                }, a, "easeInSine"));
                b.textDiv && (b.fadeAnim2 = c.animate({
                    node: b.textDiv
                }, "opacity", 1, 0, a, "easeInSine", ""));
            } else b.show = !1, b.follow = !1, b.destroy();
        },
        setPosition: function(a, b) {
            if (a != this.pointToX || b != this.pointToY) this.previousX = this.pointToX, this.previousY = this.pointToY, 
            this.pointToX = a, this.pointToY = b, this.positionChanged = !0;
        },
        followCursor: function(a) {
            var b = this;
            b.follow = a;
            clearInterval(b.interval);
            var c = b.chart.mouseX - b.sdx, d = b.chart.mouseY - b.sdy;
            !isNaN(c) && a && (b.pointToX = c - b.offsetX * b.deltaSignX, b.pointToY = d, b.followMouse(), 
            b.interval = setInterval(function() {
                b.followMouse.call(b);
            }, 40));
        },
        removeDiv: function() {
            if (this.textDiv) {
                var a = this.textDiv.parentNode;
                a && a.removeChild(this.textDiv);
            }
        },
        destroy: function() {
            clearInterval(this.interval);
            a.remove(this.set);
            this.removeDiv();
            this.set = null;
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.AmCoordinateChart = a.Class({
        inherits: a.AmChart,
        construct: function(b) {
            a.AmCoordinateChart.base.construct.call(this, b);
            this.theme = b;
            this.createEvents("rollOverGraphItem", "rollOutGraphItem", "clickGraphItem", "doubleClickGraphItem", "rightClickGraphItem", "clickGraph", "rollOverGraph", "rollOutGraph");
            this.startAlpha = 1;
            this.startDuration = 0;
            this.startEffect = "elastic";
            this.sequencedAnimation = !0;
            this.colors = "#FF6600 #FCD202 #B0DE09 #0D8ECF #2A0CD0 #CD0D74 #CC0000 #00CC00 #0000CC #DDDDDD #999999 #333333 #990000".split(" ");
            this.balloonDateFormat = "MMM DD, YYYY";
            this.valueAxes = [];
            this.graphs = [];
            this.guides = [];
            this.gridAboveGraphs = !1;
            a.applyTheme(this, b, "AmCoordinateChart");
        },
        initChart: function() {
            a.AmCoordinateChart.base.initChart.call(this);
            this.drawGraphs = !0;
            var b = this.categoryAxis;
            b && (this.categoryAxis = a.processObject(b, a.CategoryAxis, this.theme));
            this.processValueAxes();
            this.createValueAxes();
            this.processGraphs();
            this.processGuides();
            a.VML && (this.startAlpha = 1);
            this.setLegendData(this.graphs);
            this.gridAboveGraphs && (this.gridSet.toFront(), this.bulletSet.toFront(), this.balloonsSet.toFront());
        },
        createValueAxes: function() {
            if (0 === this.valueAxes.length) {
                var b = new a.ValueAxis();
                this.addValueAxis(b);
            }
        },
        parseData: function() {
            this.processValueAxes();
            this.processGraphs();
        },
        parseSerialData: function(a) {
            this.chartData = [];
            if (a) if (0 < this.processTimeout) {
                1 > this.processCount && (this.processCount = 1);
                var b = a.length / this.processCount;
                this.parseCount = Math.ceil(b) - 1;
                for (var c = 0; c < b; c++) this.delayParseSerialData(a, c);
            } else this.parseCount = 0, this.parsePartSerialData(a, 0, a.length, 0); else this.onDataUpdated();
        },
        delayParseSerialData: function(a, b) {
            var c = this, d = c.processCount;
            setTimeout(function() {
                c.parsePartSerialData.call(c, a, b * d, (b + 1) * d, b);
            }, c.processTimeout);
        },
        parsePartSerialData: function(b, c, d, e) {
            d > b.length && (d = b.length);
            var f = this.graphs, g = {}, h = this.seriesIdField;
            h || (h = this.categoryField);
            var i = !1, j, k = this.categoryAxis, l, m, n;
            k && (i = k.parseDates, l = k.forceShowField, n = k.classNameField, m = k.labelColorField, 
            j = k.categoryFunction);
            var o, p, q = {}, r;
            i && (o = a.extractPeriod(k.minPeriod), p = o.period, o = o.count, r = a.getPeriodDuration(p, o));
            var s = {};
            this.lookupTable = s;
            var t, u = this.dataDateFormat, v = {};
            for (t = c; t < d; t++) {
                var w = {}, x = b[t];
                c = x[this.categoryField];
                w.dataContext = x;
                w.category = j ? j(c, x, k) : String(c);
                l && (w.forceShow = x[l]);
                n && (w.className = x[n]);
                m && (w.labelColor = x[m]);
                s[x[h]] = w;
                if (i && (k.categoryFunction ? c = k.categoryFunction(c, x, k) : (!u || c instanceof Date || (c = c.toString() + " |"), 
                c = a.getDate(c, u, k.minPeriod)), c = a.resetDateToMin(c, p, o, k.firstDayOfWeek), 
                w.category = c, w.time = c.getTime(), isNaN(w.time))) continue;
                var y = this.valueAxes;
                w.axes = {};
                w.x = {};
                var z;
                for (z = 0; z < y.length; z++) {
                    var A = y[z].id;
                    w.axes[A] = {};
                    w.axes[A].graphs = {};
                    var B;
                    for (B = 0; B < f.length; B++) {
                        c = f[B];
                        var C = c.id, D = 1.1;
                        isNaN(c.gapPeriod) || (D = c.gapPeriod);
                        var E = c.periodValue;
                        if (c.valueAxis.id == A) {
                            w.axes[A].graphs[C] = {};
                            var F = {};
                            F.index = t;
                            var G = x;
                            c.dataProvider && (G = g);
                            F.values = this.processValues(G, c, E);
                            !c.connect && v && v[C] && 0 < D && w.time - q[C] >= r * D && (v[C].gap = !0);
                            this.processFields(c, F, G);
                            F.category = w.category;
                            F.serialDataItem = w;
                            F.graph = c;
                            w.axes[A].graphs[C] = F;
                            q[C] = w.time;
                            v[C] = F;
                        }
                    }
                }
                this.chartData[t] = w;
            }
            if (this.parseCount == e) {
                for (b = 0; b < f.length; b++) c = f[b], c.dataProvider && this.parseGraphData(c);
                this.dataChanged = !1;
                this.dispatchDataUpdated = !0;
                this.onDataUpdated();
            }
        },
        processValues: function(b, c, d) {
            var e = {}, f, g = !1;
            "candlestick" != c.type && "ohlc" != c.type || "" === d || (g = !0);
            for (var h = "value error open close low high".split(" "), i = 0; i < h.length; i++) {
                var j = h[i];
                "value" != j && "error" != j && g && (d = j.charAt(0).toUpperCase() + j.slice(1));
                var k = b[c[j + "Field"] + d];
                null !== k && (f = Number(k), isNaN(f) || (e[j] = f), "date" == c.valueAxis.type && void 0 !== k && (f = a.getDate(k, c.chart.dataDateFormat), 
                e[j] = f.getTime()));
            }
            return e;
        },
        parseGraphData: function(a) {
            var b = a.dataProvider, c = a.seriesIdField;
            c || (c = this.seriesIdField);
            c || (c = this.categoryField);
            var d;
            for (d = 0; d < b.length; d++) {
                var e = b[d], f = this.lookupTable[String(e[c])], g = a.valueAxis.id;
                f && (g = f.axes[g].graphs[a.id], g.serialDataItem = f, g.values = this.processValues(e, a, a.periodValue), 
                this.processFields(a, g, e));
            }
        },
        addValueAxis: function(a) {
            a.chart = this;
            this.valueAxes.push(a);
            this.validateData();
        },
        removeValueAxesAndGraphs: function() {
            var a = this.valueAxes, b;
            for (b = a.length - 1; -1 < b; b--) this.removeValueAxis(a[b]);
        },
        removeValueAxis: function(a) {
            var b = this.graphs, c;
            for (c = b.length - 1; 0 <= c; c--) {
                var d = b[c];
                d && d.valueAxis == a && this.removeGraph(d);
            }
            b = this.valueAxes;
            for (c = b.length - 1; 0 <= c; c--) b[c] == a && b.splice(c, 1);
            this.validateData();
        },
        addGraph: function(a) {
            this.graphs.push(a);
            this.chooseGraphColor(a, this.graphs.length - 1);
            this.validateData();
        },
        removeGraph: function(a) {
            var b = this.graphs, c;
            for (c = b.length - 1; 0 <= c; c--) b[c] == a && (b.splice(c, 1), a.destroy());
            this.validateData();
        },
        handleValueAxisZoom: function() {},
        processValueAxes: function() {
            var b = this.valueAxes, c;
            for (c = 0; c < b.length; c++) {
                var d = b[c], d = a.processObject(d, a.ValueAxis, this.theme);
                b[c] = d;
                d.chart = this;
                d.init();
                this.listenTo(d, "axisIntZoomed", this.handleValueAxisZoom);
                d.id || (d.id = "valueAxisAuto" + c + "_" + new Date().getTime());
                void 0 === d.usePrefixes && (d.usePrefixes = this.usePrefixes);
            }
        },
        processGuides: function() {
            var b = this.guides, c = this.categoryAxis;
            if (b) for (var d = 0; d < b.length; d++) {
                var e = b[d];
                (void 0 !== e.category || void 0 !== e.date) && c && c.addGuide(e);
                e.id || (e.id = "guideAuto" + d + "_" + new Date().getTime());
                var f = e.valueAxis;
                f ? (a.isString(f) && (f = this.getValueAxisById(f)), f ? f.addGuide(e) : this.valueAxes[0].addGuide(e)) : isNaN(e.value) || this.valueAxes[0].addGuide(e);
            }
        },
        processGraphs: function() {
            var b = this.graphs, c;
            this.graphsById = {};
            for (c = 0; c < b.length; c++) {
                var d = b[c], d = a.processObject(d, a.AmGraph, this.theme);
                b[c] = d;
                this.chooseGraphColor(d, c);
                d.chart = this;
                d.init();
                a.isString(d.valueAxis) && (d.valueAxis = this.getValueAxisById(d.valueAxis));
                d.valueAxis || (d.valueAxis = this.valueAxes[0]);
                d.id || (d.id = "graphAuto" + c + "_" + new Date().getTime());
                this.graphsById[d.id] = d;
            }
        },
        formatString: function(b, c, d) {
            var e = c.graph, f = e.valueAxis;
            f.duration && c.values.value && (f = a.formatDuration(c.values.value, f.duration, "", f.durationUnits, f.maxInterval, f.numberFormatter), 
            b = b.split("[[value]]").join(f));
            b = a.massReplace(b, {
                "[[title]]": e.title,
                "[[description]]": c.description
            });
            b = d ? a.fixNewLines(b) : a.fixBrakes(b);
            return b = a.cleanFromEmpty(b);
        },
        getBalloonColor: function(b, c, d) {
            var e = b.lineColor, f = b.balloonColor;
            d && (f = e);
            d = b.fillColorsR;
            "object" == typeof d ? e = d[0] : void 0 !== d && (e = d);
            c.isNegative && (d = b.negativeLineColor, b = b.negativeFillColors, "object" == typeof b ? d = b[0] : void 0 !== b && (d = b), 
            void 0 !== d && (e = d));
            void 0 !== c.color && (e = c.color);
            void 0 !== c.lineColor && (e = c.lineColor);
            c = c.fillColors;
            void 0 !== c && (e = c, a.ifArray(c) && (e = c[0]));
            void 0 === f && (f = e);
            return f;
        },
        getGraphById: function(b) {
            return a.getObjById(this.graphs, b);
        },
        getValueAxisById: function(b) {
            return a.getObjById(this.valueAxes, b);
        },
        processFields: function(b, c, d) {
            if (b.itemColors) {
                var e = b.itemColors, f = c.index;
                c.color = f < e.length ? e[f] : a.randomColor();
            }
            e = "lineColor color alpha fillColors description bullet customBullet bulletSize bulletConfig url labelColor dashLength pattern gap className".split(" ");
            for (f = 0; f < e.length; f++) {
                var g = e[f], h = b[g + "Field"];
                h && (h = d[h], a.isDefined(h) && (c[g] = h));
            }
            c.dataContext = d;
        },
        chooseGraphColor: function(b, c) {
            if (b.lineColor) b.lineColorR = b.lineColor; else {
                var d;
                d = this.colors.length > c ? this.colors[c] : b.lineColorR ? b.lineColorR : a.randomColor();
                b.lineColorR = d;
            }
            b.fillColorsR = b.fillColors ? b.fillColors : b.lineColorR;
            b.bulletBorderColorR = b.bulletBorderColor ? b.bulletBorderColor : b.useLineColorForBulletBorder ? b.lineColorR : b.bulletColor;
            b.bulletColorR = b.bulletColor ? b.bulletColor : b.lineColorR;
            if (d = this.patterns) b.pattern = d[c];
        },
        handleLegendEvent: function(a) {
            var b = a.type;
            a = a.dataItem;
            if (!this.legend.data && a) {
                var c = a.hidden, d = a.showBalloon;
                switch (b) {
                  case "clickMarker":
                    this.textClickEnabled && (d ? this.hideGraphsBalloon(a) : this.showGraphsBalloon(a));
                    break;

                  case "clickLabel":
                    d ? this.hideGraphsBalloon(a) : this.showGraphsBalloon(a);
                    break;

                  case "rollOverItem":
                    c || this.highlightGraph(a);
                    break;

                  case "rollOutItem":
                    c || this.unhighlightGraph();
                    break;

                  case "hideItem":
                    this.hideGraph(a);
                    break;

                  case "showItem":
                    this.showGraph(a);
                }
            }
        },
        highlightGraph: function(a) {
            var b = this.graphs, c, d = .2;
            this.legend && (d = this.legend.rollOverGraphAlpha);
            if (1 != d) for (c = 0; c < b.length; c++) {
                var e = b[c];
                e != a && e.changeOpacity(d);
            }
        },
        unhighlightGraph: function() {
            var a;
            this.legend && (a = this.legend.rollOverGraphAlpha);
            if (1 != a) {
                a = this.graphs;
                var b;
                for (b = 0; b < a.length; b++) a[b].changeOpacity(1);
            }
        },
        showGraph: function(a) {
            a.switchable && (a.hidden = !1, this.dataChanged = !0, "xy" != this.type && (this.marginsUpdated = !1), 
            this.chartCreated && this.initChart());
        },
        hideGraph: function(a) {
            a.switchable && (this.dataChanged = !0, "xy" != this.type && (this.marginsUpdated = !1), 
            a.hidden = !0, this.chartCreated && this.initChart());
        },
        hideGraphsBalloon: function(a) {
            a.showBalloon = !1;
            this.updateLegend();
        },
        showGraphsBalloon: function(a) {
            a.showBalloon = !0;
            this.updateLegend();
        },
        updateLegend: function() {
            this.legend && this.legend.invalidateSize();
        },
        resetAnimation: function() {
            var a = this.graphs;
            if (a) {
                var b;
                for (b = 0; b < a.length; b++) a[b].animationPlayed = !1;
            }
        },
        animateAgain: function() {
            this.resetAnimation();
            this.validateNow();
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.TrendLine = a.Class({
        construct: function(b) {
            this.cname = "TrendLine";
            this.createEvents("click");
            this.isProtected = !1;
            this.dashLength = 0;
            this.lineColor = "#00CC00";
            this.lineThickness = this.lineAlpha = 1;
            a.applyTheme(this, b, this.cname);
        },
        draw: function() {
            var b = this;
            b.destroy();
            var c = b.chart, d = c.container, e, f, g, h, i = b.categoryAxis, j = b.initialDate, k = b.initialCategory, l = b.finalDate, m = b.finalCategory, n = b.valueAxis, o = b.valueAxisX, p = b.initialXValue, q = b.finalXValue, r = b.initialValue, s = b.finalValue, t = n.recalculateToPercents, u = c.dataDateFormat;
            i && (j && (j = a.getDate(j, u, "fff"), b.initialDate = j, e = i.dateToCoordinate(j)), 
            k && (e = i.categoryToCoordinate(k)), l && (l = a.getDate(l, u, "fff"), b.finalDate = l, 
            f = i.dateToCoordinate(l)), m && (f = i.categoryToCoordinate(m)));
            o && !t && (isNaN(p) || (e = o.getCoordinate(p)), isNaN(q) || (f = o.getCoordinate(q)));
            n && !t && (isNaN(r) || (g = n.getCoordinate(r)), isNaN(s) || (h = n.getCoordinate(s)));
            if (!(isNaN(e) || isNaN(f) || isNaN(g) || isNaN(g))) {
                c.rotate ? (i = [ g, h ], h = [ e, f ]) : (i = [ e, f ], h = [ g, h ]);
                j = b.lineColor;
                g = a.line(d, i, h, j, b.lineAlpha, b.lineThickness, b.dashLength);
                e = i;
                f = h;
                m = i[1] - i[0];
                n = h[1] - h[0];
                0 === m && (m = .01);
                0 === n && (n = .01);
                k = m / Math.abs(m);
                l = n / Math.abs(n);
                n = 90 * Math.PI / 180 - Math.asin(m / (m * n / Math.abs(m * n) * Math.sqrt(Math.pow(m, 2) + Math.pow(n, 2))));
                m = Math.abs(5 * Math.cos(n));
                n = Math.abs(5 * Math.sin(n));
                e.push(i[1] - k * n, i[0] - k * n);
                f.push(h[1] + l * m, h[0] + l * m);
                h = a.polygon(d, e, f, j, .005, 0);
                d = d.set([ h, g ]);
                d.translate(c.marginLeftReal, c.marginTopReal);
                c.trendLinesSet.push(d);
                a.setCN(c, g, "trend-line");
                a.setCN(c, g, "trend-line-" + b.id);
                b.line = g;
                b.set = d;
                if (g = b.initialImage) g = a.processObject(g, a.Image, b.theme), g.chart = c, g.draw(), 
                g.translate(e[0] + g.offsetX, f[0] + g.offsetY), d.push(g.set);
                if (g = b.finalImage) g = a.processObject(g, a.Image, b.theme), g.chart = c, g.draw(), 
                g.translate(e[1] + g.offsetX, f[1] + g.offsetY), d.push(g.set);
                h.mouseup(function() {
                    b.handleLineClick();
                }).mouseover(function() {
                    b.handleLineOver();
                }).mouseout(function() {
                    b.handleLineOut();
                });
                h.touchend && h.touchend(function() {
                    b.handleLineClick();
                });
                d.clipRect(0, 0, c.plotAreaWidth, c.plotAreaHeight);
            }
        },
        handleLineClick: function() {
            this.fire({
                type: "click",
                trendLine: this,
                chart: this.chart
            });
        },
        handleLineOver: function() {
            var a = this.rollOverColor;
            void 0 !== a && this.line.attr({
                stroke: a
            });
            this.balloonText && (clearTimeout(this.chart.hoverInt), a = this.line.getBBox(), 
            this.chart.showBalloon(this.balloonText, this.lineColor, !0, this.x + a.x + a.width / 2, this.y + a.y + a.height / 2));
        },
        handleLineOut: function() {
            this.line.attr({
                stroke: this.lineColor
            });
            this.balloonText && this.chart.hideBalloon();
        },
        destroy: function() {
            a.remove(this.set);
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.Image = a.Class({
        construct: function(b) {
            this.cname = "Image";
            this.height = this.width = 20;
            this.rotation = this.offsetY = this.offsetX = 0;
            this.balloonColor = this.color = "#000000";
            this.opacity = 1;
            a.applyTheme(this, b, this.cname);
        },
        draw: function() {
            var a = this;
            a.set && a.set.remove();
            var b = a.chart.container;
            a.set = b.set();
            var c, d;
            a.url ? (c = b.image(a.url, 0, 0, a.width, a.height), d = 1) : a.svgPath && (c = b.path(a.svgPath), 
            c.setAttr("fill", a.color), c.setAttr("stroke", a.outlineColor), b = c.getBBox(), 
            d = Math.min(a.width / b.width, a.height / b.height));
            c && (c.setAttr("opacity", a.opacity), a.set.rotate(a.rotation), c.translate(-a.width / 2, -a.height / 2, d), 
            a.balloonText && c.mouseover(function() {
                a.chart.showBalloon(a.balloonText, a.balloonColor, !0);
            }).mouseout(function() {
                a.chart.hideBalloon();
            }).touchend(function() {
                a.chart.hideBalloon();
            }).touchstart(function() {
                a.chart.showBalloon(a.balloonText, a.balloonColor, !0);
            }), a.set.push(c));
        },
        translate: function(a, b) {
            this.set && this.set.translate(a, b);
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.circle = function(b, c, d, e, f, g, h, i, j) {
        0 >= c && (c = .001);
        if (void 0 == f || 0 === f) f = .01;
        void 0 === g && (g = "#000000");
        void 0 === h && (h = 0);
        e = {
            fill: d,
            stroke: g,
            "fill-opacity": e,
            "stroke-width": f,
            "stroke-opacity": h
        };
        b = isNaN(j) ? b.circle(0, 0, c).attr(e) : b.ellipse(0, 0, c, j).attr(e);
        i && b.gradient("radialGradient", [ d, a.adjustLuminosity(d, -.6) ]);
        return b;
    };
    a.text = function(b, c, d, e, f, g, h, i) {
        g || (g = "middle");
        "right" == g && (g = "end");
        "left" == g && (g = "start");
        isNaN(i) && (i = 1);
        void 0 !== c && (c = String(c), a.isIE && !a.isModern && (c = c.replace("&amp;", "&"), 
        c = c.replace("&", "&amp;")));
        d = {
            fill: d,
            "font-family": e,
            "font-size": f + "px",
            opacity: i
        };
        !0 === h && (d["font-weight"] = "bold");
        d["text-anchor"] = g;
        return b.text(c, d);
    };
    a.polygon = function(b, c, d, e, f, g, h, i, j, k, l) {
        isNaN(g) && (g = .01);
        isNaN(i) && (i = f);
        var m = e, n = !1;
        "object" == typeof m && 1 < m.length && (n = !0, m = m[0]);
        void 0 === h && (h = m);
        f = {
            fill: m,
            stroke: h,
            "fill-opacity": f,
            "stroke-width": g,
            "stroke-opacity": i
        };
        void 0 !== l && 0 < l && (f["stroke-dasharray"] = l);
        l = a.dx;
        g = a.dy;
        b.handDrawn && (d = a.makeHD(c, d, b.handDrawScatter), c = d[0], d = d[1]);
        h = Math.round;
        k && (c[o] = a.roundTo(c[o], 5), d[o] = a.roundTo(d[o], 5), h = Number);
        i = "M" + (h(c[0]) + l) + "," + (h(d[0]) + g);
        for (var o = 1; o < c.length; o++) k && (c[o] = a.roundTo(c[o], 5), d[o] = a.roundTo(d[o], 5)), 
        i += " L" + (h(c[o]) + l) + "," + (h(d[o]) + g);
        b = b.path(i + " Z").attr(f);
        n && b.gradient("linearGradient", e, j);
        return b;
    };
    a.rect = function(b, c, d, e, f, g, h, i, j, k, l) {
        if (isNaN(c) || isNaN(d)) return b.set();
        isNaN(g) && (g = 0);
        void 0 === j && (j = 0);
        void 0 === k && (k = 270);
        isNaN(f) && (f = 0);
        var m = e, n = !1;
        "object" == typeof m && (m = m[0], n = !0);
        void 0 === h && (h = m);
        void 0 === i && (i = f);
        c = Math.round(c);
        d = Math.round(d);
        var o = 0, p = 0;
        0 > c && (c = Math.abs(c), o = -c);
        0 > d && (d = Math.abs(d), p = -d);
        o += a.dx;
        p += a.dy;
        f = {
            fill: m,
            stroke: h,
            "fill-opacity": f,
            "stroke-opacity": i
        };
        void 0 !== l && 0 < l && (f["stroke-dasharray"] = l);
        b = b.rect(o, p, c, d, j, g).attr(f);
        n && b.gradient("linearGradient", e, k);
        return b;
    };
    a.bullet = function(b, c, d, e, f, g, h, i, j, k, l, m, n) {
        var o;
        "circle" == c && (c = "round");
        switch (c) {
          case "round":
            o = a.circle(b, d / 2, e, f, g, h, i);
            break;

          case "square":
            o = a.polygon(b, [ -d / 2, d / 2, d / 2, -d / 2 ], [ d / 2, d / 2, -d / 2, -d / 2 ], e, f, g, h, i, k - 180, void 0, n);
            break;

          case "rectangle":
            o = a.polygon(b, [ -d, d, d, -d ], [ d / 2, d / 2, -d / 2, -d / 2 ], e, f, g, h, i, k - 180, void 0, n);
            break;

          case "diamond":
            o = a.polygon(b, [ -d / 2, 0, d / 2, 0 ], [ 0, -d / 2, 0, d / 2 ], e, f, g, h, i);
            break;

          case "triangleUp":
            o = a.triangle(b, d, 0, e, f, g, h, i);
            break;

          case "triangleDown":
            o = a.triangle(b, d, 180, e, f, g, h, i);
            break;

          case "triangleLeft":
            o = a.triangle(b, d, 270, e, f, g, h, i);
            break;

          case "triangleRight":
            o = a.triangle(b, d, 90, e, f, g, h, i);
            break;

          case "bubble":
            o = a.circle(b, d / 2, e, f, g, h, i, !0);
            break;

          case "line":
            o = a.line(b, [ -d / 2, d / 2 ], [ 0, 0 ], e, f, g, h, i);
            break;

          case "yError":
            o = b.set();
            o.push(a.line(b, [ 0, 0 ], [ -d / 2, d / 2 ], e, f, g));
            o.push(a.line(b, [ -j, j ], [ -d / 2, -d / 2 ], e, f, g));
            o.push(a.line(b, [ -j, j ], [ d / 2, d / 2 ], e, f, g));
            break;

          case "xError":
            o = b.set(), o.push(a.line(b, [ -d / 2, d / 2 ], [ 0, 0 ], e, f, g)), o.push(a.line(b, [ -d / 2, -d / 2 ], [ -j, j ], e, f, g)), 
            o.push(a.line(b, [ d / 2, d / 2 ], [ -j, j ], e, f, g));
        }
        o && o.pattern(l, 0/0, m);
        return o;
    };
    a.triangle = function(a, b, c, d, e, f, g, h) {
        if (void 0 === f || 0 === f) f = 1;
        void 0 === g && (g = "#000");
        void 0 === h && (h = 0);
        d = {
            fill: d,
            stroke: g,
            "fill-opacity": e,
            "stroke-width": f,
            "stroke-opacity": h
        };
        b /= 2;
        var i;
        0 === c && (i = " M" + -b + "," + b + " L0," + -b + " L" + b + "," + b + " Z");
        180 == c && (i = " M" + -b + "," + -b + " L0," + b + " L" + b + "," + -b + " Z");
        90 == c && (i = " M" + -b + "," + -b + " L" + b + ",0 L" + -b + "," + b + " Z");
        270 == c && (i = " M" + -b + ",0 L" + b + "," + b + " L" + b + "," + -b + " Z");
        return a.path(i).attr(d);
    };
    a.line = function(b, c, d, e, f, g, h, i, j, k, l) {
        if (b.handDrawn && !l) return a.handDrawnLine(b, c, d, e, f, g, h, i, j, k, l);
        g = {
            fill: "none",
            "stroke-width": g
        };
        void 0 !== h && 0 < h && (g["stroke-dasharray"] = h);
        isNaN(f) || (g["stroke-opacity"] = f);
        e && (g.stroke = e);
        e = Math.round;
        k && (e = Number, c[0] = a.roundTo(c[0], 5), d[0] = a.roundTo(d[0], 5));
        k = a.dx;
        f = a.dy;
        h = "M" + (e(c[0]) + k) + "," + (e(d[0]) + f);
        for (i = 1; i < c.length; i++) c[i] = a.roundTo(c[i], 5), d[i] = a.roundTo(d[i], 5), 
        h += " L" + (e(c[i]) + k) + "," + (e(d[i]) + f);
        if (a.VML) return b.path(h, void 0, !0).attr(g);
        j && (h += " M0,0 L0,0");
        return b.path(h).attr(g);
    };
    a.makeHD = function(a, b, c) {
        for (var d = [], e = [], f = 1; f < a.length; f++) for (var g = Number(a[f - 1]), h = Number(b[f - 1]), i = Number(a[f]), j = Number(b[f]), k = Math.round(Math.sqrt(Math.pow(i - g, 2) + Math.pow(j - h, 2)) / 50) + 1, i = (i - g) / k, j = (j - h) / k, l = 0; l <= k; l++) {
            var m = h + l * j + Math.random() * c;
            d.push(g + l * i + Math.random() * c);
            e.push(m);
        }
        return [ d, e ];
    };
    a.handDrawnLine = function(b, c, d, e, f, g, h, i, j, k) {
        var l, m = b.set();
        for (l = 1; l < c.length; l++) for (var n = [ c[l - 1], c[l] ], o = [ d[l - 1], d[l] ], o = a.makeHD(n, o, b.handDrawScatter), n = o[0], o = o[1], p = 1; p < n.length; p++) m.push(a.line(b, [ n[p - 1], n[p] ], [ o[p - 1], o[p] ], e, f, g + Math.random() * b.handDrawThickness - b.handDrawThickness / 2, h, i, j, k, !0));
        return m;
    };
    a.doNothing = function(a) {
        return a;
    };
    a.drop = function(a, b, c, d, e, f, g, h) {
        var i = 1 / 180 * Math.PI, j = c - 20, k = Math.sin(j * i) * b, l = Math.cos(j * i) * b, m = Math.sin((j + 40) * i) * b, n = Math.cos((j + 40) * i) * b, o = .8 * b, p = -b / 3, q = b / 3;
        0 === c && (p = -p, q = 0);
        180 == c && (q = 0);
        90 == c && (p = 0);
        270 == c && (p = 0, q = -q);
        c = {
            fill: d,
            stroke: g,
            "stroke-width": f,
            "stroke-opacity": h,
            "fill-opacity": e
        };
        b = "M" + k + "," + l + " A" + b + "," + b + ",0,1,1," + m + "," + n + (" A" + o + "," + o + ",0,0,0," + (Math.sin((j + 20) * i) * b + q) + "," + (Math.cos((j + 20) * i) * b + p));
        b += " A" + o + "," + o + ",0,0,0," + k + "," + l;
        return a.path(b, void 0, void 0, "1000,1000").attr(c);
    };
    a.wedge = function(b, c, d, e, f, g, h, i, j, k, l, m, n, o) {
        var p = Math.round;
        g = p(g);
        h = p(h);
        i = p(i);
        var q = p(h / g * i), r = a.VML, s = 359.5 + g / 100;
        359.94 < s && (s = 359.94);
        f >= s && (f = s);
        var t = 1 / 180 * Math.PI, s = c + Math.sin(e * t) * i, u = d - Math.cos(e * t) * q, v = c + Math.sin(e * t) * g, w = d - Math.cos(e * t) * h, x = c + Math.sin((e + f) * t) * g, y = d - Math.cos((e + f) * t) * h, z = c + Math.sin((e + f) * t) * i, t = d - Math.cos((e + f) * t) * q, A = {
            fill: a.adjustLuminosity(k.fill, -.2),
            "stroke-opacity": 0,
            "fill-opacity": k["fill-opacity"]
        }, B = 0;
        180 < Math.abs(f) && (B = 1);
        e = b.set();
        var C;
        r && (s = p(10 * s), v = p(10 * v), x = p(10 * x), z = p(10 * z), u = p(10 * u), 
        w = p(10 * w), y = p(10 * y), t = p(10 * t), c = p(10 * c), j = p(10 * j), d = p(10 * d), 
        g *= 10, h *= 10, i *= 10, q *= 10, 1 > Math.abs(f) && 1 >= Math.abs(x - v) && 1 >= Math.abs(y - w) && (C = !0));
        f = "";
        var D;
        m && (A["fill-opacity"] = 0, A["stroke-opacity"] = k["stroke-opacity"] / 2, A.stroke = k.stroke);
        if (0 < j) {
            D = " M" + s + "," + (u + j) + " L" + v + "," + (w + j);
            r ? (C || (D += " A" + (c - g) + "," + (j + d - h) + "," + (c + g) + "," + (j + d + h) + "," + v + "," + (w + j) + "," + x + "," + (y + j)), 
            D += " L" + z + "," + (t + j), 0 < i && (C || (D += " B" + (c - i) + "," + (j + d - q) + "," + (c + i) + "," + (j + d + q) + "," + z + "," + (j + t) + "," + s + "," + (j + u)))) : (D += " A" + g + "," + h + ",0," + B + ",1," + x + "," + (y + j) + " L" + z + "," + (t + j), 
            0 < i && (D += " A" + i + "," + q + ",0," + B + ",0," + s + "," + (u + j)));
            D += " Z";
            var E = j;
            r && (E /= 10);
            for (var F = 0; F < E; F += 10) {
                var G = b.path(D, void 0, void 0, "1000,1000").attr(A);
                e.push(G);
                G.translate(0, -F);
            }
            D = b.path(" M" + s + "," + u + " L" + s + "," + (u + j) + " L" + v + "," + (w + j) + " L" + v + "," + w + " L" + s + "," + u + " Z", void 0, void 0, "1000,1000").attr(A);
            j = b.path(" M" + x + "," + y + " L" + x + "," + (y + j) + " L" + z + "," + (t + j) + " L" + z + "," + t + " L" + x + "," + y + " Z", void 0, void 0, "1000,1000").attr(A);
            e.push(D);
            e.push(j);
        }
        r ? (C || (f = " A" + p(c - g) + "," + p(d - h) + "," + p(c + g) + "," + p(d + h) + "," + p(v) + "," + p(w) + "," + p(x) + "," + p(y)), 
        h = " M" + p(s) + "," + p(u) + " L" + p(v) + "," + p(w) + f + " L" + p(z) + "," + p(t)) : h = " M" + s + "," + u + " L" + v + "," + w + (" A" + g + "," + h + ",0," + B + ",1," + x + "," + y) + " L" + z + "," + t;
        0 < i && (r ? C || (h += " B" + (c - i) + "," + (d - q) + "," + (c + i) + "," + (d + q) + "," + z + "," + t + "," + s + "," + u) : h += " A" + i + "," + q + ",0," + B + ",0," + s + "," + u);
        b.handDrawn && (i = a.line(b, [ s, v ], [ u, w ], k.stroke, k.thickness * Math.random() * b.handDrawThickness, k["stroke-opacity"]), 
        e.push(i));
        b = b.path(h + " Z", void 0, void 0, "1000,1000").attr(k);
        if (l) {
            i = [];
            for (q = 0; q < l.length; q++) i.push(a.adjustLuminosity(k.fill, l[q]));
            "radial" != o || a.isModern || (i = []);
            0 < i.length && b.gradient(o + "Gradient", i);
        }
        a.isModern && "radial" == o && b.grad && (b.grad.setAttribute("gradientUnits", "userSpaceOnUse"), 
        b.grad.setAttribute("r", g), b.grad.setAttribute("cx", c), b.grad.setAttribute("cy", d));
        b.pattern(m, 0/0, n);
        e.wedge = b;
        e.push(b);
        return e;
    };
    a.rgb2hex = function(a) {
        return (a = a.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i)) && 4 === a.length ? "#" + ("0" + parseInt(a[1], 10).toString(16)).slice(-2) + ("0" + parseInt(a[2], 10).toString(16)).slice(-2) + ("0" + parseInt(a[3], 10).toString(16)).slice(-2) : "";
    };
    a.adjustLuminosity = function(b, c) {
        b && -1 != b.indexOf("rgb") && (b = a.rgb2hex(b));
        b = String(b).replace(/[^0-9a-f]/gi, "");
        6 > b.length && (b = String(b[0]) + String(b[0]) + String(b[1]) + String(b[1]) + String(b[2]) + String(b[2]));
        c = c || 0;
        var d = "#", e, f;
        for (f = 0; 3 > f; f++) e = parseInt(b.substr(2 * f, 2), 16), e = Math.round(Math.min(Math.max(0, e + e * c), 255)).toString(16), 
        d += ("00" + e).substr(e.length);
        return d;
    };
}();

!function() {
    var a = window.AmCharts;
    a.Bezier = a.Class({
        construct: function(b, c, d, e, f, g, h, i, j, k, l) {
            var m, n;
            "object" == typeof h && 1 < h.length && (n = !0, m = h, h = h[0]);
            "object" == typeof i && (i = i[0]);
            0 === i && (h = "none");
            g = {
                fill: h,
                "fill-opacity": i,
                "stroke-width": g
            };
            void 0 !== j && 0 < j && (g["stroke-dasharray"] = j);
            isNaN(f) || (g["stroke-opacity"] = f);
            e && (g.stroke = e);
            e = "M" + Math.round(c[0]) + "," + Math.round(d[0]);
            f = [];
            for (j = 0; j < c.length; j++) f.push({
                x: Number(c[j]),
                y: Number(d[j])
            });
            1 < f.length && (c = this.interpolate(f), e += this.drawBeziers(c));
            k ? e += k : a.VML || (e += "M0,0 L0,0");
            this.path = b.path(e).attr(g);
            this.node = this.path.node;
            n && this.path.gradient("linearGradient", m, l);
        },
        interpolate: function(b) {
            var c = [];
            c.push({
                x: b[0].x,
                y: b[0].y
            });
            var d = b[1].x - b[0].x, e = b[1].y - b[0].y, f = a.bezierX, g = a.bezierY;
            c.push({
                x: b[0].x + d / f,
                y: b[0].y + e / g
            });
            var h;
            for (h = 1; h < b.length - 1; h++) {
                var i = b[h - 1], j = b[h], e = b[h + 1];
                isNaN(e.x) && (e = j);
                isNaN(j.x) && (j = i);
                isNaN(i.x) && (i = j);
                d = e.x - j.x;
                e = e.y - i.y;
                i = j.x - i.x;
                i > d && (i = d);
                c.push({
                    x: j.x - i / f,
                    y: j.y - e / g
                });
                c.push({
                    x: j.x,
                    y: j.y
                });
                c.push({
                    x: j.x + i / f,
                    y: j.y + e / g
                });
            }
            e = b[b.length - 1].y - b[b.length - 2].y;
            d = b[b.length - 1].x - b[b.length - 2].x;
            c.push({
                x: b[b.length - 1].x - d / f,
                y: b[b.length - 1].y - e / g
            });
            c.push({
                x: b[b.length - 1].x,
                y: b[b.length - 1].y
            });
            return c;
        },
        drawBeziers: function(a) {
            var b = "", c;
            for (c = 0; c < (a.length - 1) / 3; c++) b += this.drawBezierMidpoint(a[3 * c], a[3 * c + 1], a[3 * c + 2], a[3 * c + 3]);
            return b;
        },
        drawBezierMidpoint: function(a, b, c, d) {
            var e = Math.round, f = this.getPointOnSegment(a, b, .75), g = this.getPointOnSegment(d, c, .75), h = (d.x - a.x) / 16, i = (d.y - a.y) / 16, j = this.getPointOnSegment(a, b, .375);
            a = this.getPointOnSegment(f, g, .375);
            a.x -= h;
            a.y -= i;
            b = this.getPointOnSegment(g, f, .375);
            b.x += h;
            b.y += i;
            c = this.getPointOnSegment(d, c, .375);
            h = this.getMiddle(j, a);
            f = this.getMiddle(f, g);
            g = this.getMiddle(b, c);
            j = " Q" + e(j.x) + "," + e(j.y) + "," + e(h.x) + "," + e(h.y);
            j += " Q" + e(a.x) + "," + e(a.y) + "," + e(f.x) + "," + e(f.y);
            j += " Q" + e(b.x) + "," + e(b.y) + "," + e(g.x) + "," + e(g.y);
            return j += " Q" + e(c.x) + "," + e(c.y) + "," + e(d.x) + "," + e(d.y);
        },
        getMiddle: function(a, b) {
            return {
                x: (a.x + b.x) / 2,
                y: (a.y + b.y) / 2
            };
        },
        getPointOnSegment: function(a, b, c) {
            return {
                x: a.x + (b.x - a.x) * c,
                y: a.y + (b.y - a.y) * c
            };
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.AmDraw = a.Class({
        construct: function(b, c, d, e) {
            a.SVG_NS = "http://www.w3.org/2000/svg";
            a.SVG_XLINK = "http://www.w3.org/1999/xlink";
            a.hasSVG = !!document.createElementNS && !!document.createElementNS(a.SVG_NS, "svg").createSVGRect;
            1 > c && (c = 10);
            1 > d && (d = 10);
            this.div = b;
            this.width = c;
            this.height = d;
            this.rBin = document.createElement("div");
            a.hasSVG ? (a.SVG = !0, c = this.createSvgElement("svg"), b.appendChild(c), this.container = c, 
            this.addDefs(e), this.R = new a.SVGRenderer(this)) : a.isIE && a.VMLRenderer && (a.VML = !0, 
            a.vmlStyleSheet || (document.namespaces.add("amvml", "urn:schemas-microsoft-com:vml"), 
            31 > document.styleSheets.length ? (c = document.createStyleSheet(), c.addRule(".amvml", "behavior:url(#default#VML); display:inline-block; antialias:true"), 
            a.vmlStyleSheet = c) : document.styleSheets[0].addRule(".amvml", "behavior:url(#default#VML); display:inline-block; antialias:true")), 
            this.container = b, this.R = new a.VMLRenderer(this, e), this.R.disableSelection(b));
        },
        createSvgElement: function(b) {
            return document.createElementNS(a.SVG_NS, b);
        },
        circle: function(b, c, d, e) {
            var f = new a.AmDObject("circle", this);
            f.attr({
                r: d,
                cx: b,
                cy: c
            });
            this.addToContainer(f.node, e);
            return f;
        },
        ellipse: function(b, c, d, e, f) {
            var g = new a.AmDObject("ellipse", this);
            g.attr({
                rx: d,
                ry: e,
                cx: b,
                cy: c
            });
            this.addToContainer(g.node, f);
            return g;
        },
        setSize: function(a, b) {
            0 < a && 0 < b && (this.container.style.width = a + "px", this.container.style.height = b + "px");
        },
        rect: function(b, c, d, e, f, g, h) {
            var i = new a.AmDObject("rect", this);
            a.VML && (f = Math.round(100 * f / Math.min(d, e)), d += 2 * g, e += 2 * g, i.bw = g, 
            i.node.style.marginLeft = -g, i.node.style.marginTop = -g);
            1 > d && (d = 1);
            1 > e && (e = 1);
            i.attr({
                x: b,
                y: c,
                width: d,
                height: e,
                rx: f,
                ry: f,
                "stroke-width": g
            });
            this.addToContainer(i.node, h);
            return i;
        },
        image: function(b, c, d, e, f, g) {
            var h = new a.AmDObject("image", this);
            h.attr({
                x: c,
                y: d,
                width: e,
                height: f
            });
            this.R.path(h, b);
            this.addToContainer(h.node, g);
            return h;
        },
        addToContainer: function(a, b) {
            b || (b = this.container);
            b.appendChild(a);
        },
        text: function(a, b, c) {
            return this.R.text(a, b, c);
        },
        path: function(b, c, d, e) {
            var f = new a.AmDObject("path", this);
            e || (e = "100,100");
            f.attr({
                cs: e
            });
            d ? f.attr({
                dd: b
            }) : f.attr({
                d: b
            });
            this.addToContainer(f.node, c);
            return f;
        },
        set: function(a) {
            return this.R.set(a);
        },
        remove: function(a) {
            if (a) {
                var b = this.rBin;
                b.appendChild(a);
                b.innerHTML = "";
            }
        },
        renderFix: function() {
            var a = this.container, b = a.style;
            b.top = "0px";
            b.left = "0px";
            try {
                var c = a.getBoundingClientRect(), d = c.left - Math.round(c.left), e = c.top - Math.round(c.top);
                d && (b.left = d + "px");
                e && (b.top = e + "px");
            } catch (f) {}
        },
        update: function() {
            this.R.update();
        },
        addDefs: function(b) {
            if (a.hasSVG) {
                var c = this.createSvgElement("desc"), d = this.container;
                d.setAttribute("version", "1.1");
                d.style.position = "absolute";
                this.setSize(this.width, this.height);
                a.rtl && (d.setAttribute("direction", "rtl"), d.style.left = "auto", d.style.right = "0px");
                b && (b.addCodeCredits && c.appendChild(document.createTextNode("JavaScript chart by amCharts " + b.version)), 
                d.appendChild(c), b.defs && (c = this.createSvgElement("defs"), d.appendChild(c), 
                a.parseDefs(b.defs, c), this.defs = c));
            }
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.AmDObject = a.Class({
        construct: function(a, b) {
            this.D = b;
            this.R = b.R;
            this.node = this.R.create(this, a);
            this.y = this.x = 0;
            this.scale = 1;
        },
        attr: function(a) {
            this.R.attr(this, a);
            return this;
        },
        getAttr: function(a) {
            return this.node.getAttribute(a);
        },
        setAttr: function(a, b) {
            this.R.setAttr(this, a, b);
            return this;
        },
        clipRect: function(a, b, c, d) {
            this.R.clipRect(this, a, b, c, d);
        },
        translate: function(a, b, c, d) {
            d || (a = Math.round(a), b = Math.round(b));
            this.R.move(this, a, b, c);
            this.x = a;
            this.y = b;
            this.scale = c;
            this.angle && this.rotate(this.angle);
        },
        rotate: function(a, b) {
            this.R.rotate(this, a, b);
            this.angle = a;
        },
        animate: function(b, c, d) {
            for (var e in b) if (b.hasOwnProperty(e)) {
                var f = e, g = b[e];
                d = a.getEffect(d);
                this.R.animate(this, f, g, c, d);
            }
        },
        push: function(a) {
            if (a) {
                var b = this.node;
                b.appendChild(a.node);
                var c = a.clipPath;
                c && b.appendChild(c);
                (a = a.grad) && b.appendChild(a);
            }
        },
        text: function(a) {
            this.R.setText(this, a);
        },
        remove: function() {
            this.stop();
            this.R.remove(this);
        },
        clear: function() {
            var a = this.node;
            if (a.hasChildNodes()) for (;1 <= a.childNodes.length; ) a.removeChild(a.firstChild);
        },
        hide: function() {
            this.setAttr("visibility", "hidden");
        },
        show: function() {
            this.setAttr("visibility", "visible");
        },
        getBBox: function() {
            return this.R.getBBox(this);
        },
        toFront: function() {
            var a = this.node;
            if (a) {
                this.prevNextNode = a.nextSibling;
                var b = a.parentNode;
                b && b.appendChild(a);
            }
        },
        toPrevious: function() {
            var a = this.node;
            a && this.prevNextNode && (a = a.parentNode) && a.insertBefore(this.prevNextNode, null);
        },
        toBack: function() {
            var a = this.node;
            if (a) {
                this.prevNextNode = a.nextSibling;
                var b = a.parentNode;
                if (b) {
                    var c = b.firstChild;
                    c && b.insertBefore(a, c);
                }
            }
        },
        mouseover: function(a) {
            this.R.addListener(this, "mouseover", a);
            return this;
        },
        mouseout: function(a) {
            this.R.addListener(this, "mouseout", a);
            return this;
        },
        click: function(a) {
            this.R.addListener(this, "click", a);
            return this;
        },
        dblclick: function(a) {
            this.R.addListener(this, "dblclick", a);
            return this;
        },
        mousedown: function(a) {
            this.R.addListener(this, "mousedown", a);
            return this;
        },
        mouseup: function(a) {
            this.R.addListener(this, "mouseup", a);
            return this;
        },
        touchmove: function(a) {
            this.R.addListener(this, "touchmove", a);
            return this;
        },
        touchstart: function(a) {
            this.R.addListener(this, "touchstart", a);
            return this;
        },
        touchend: function(a) {
            this.R.addListener(this, "touchend", a);
            return this;
        },
        contextmenu: function(a) {
            this.node.addEventListener ? this.node.addEventListener("contextmenu", a, !0) : this.R.addListener(this, "contextmenu", a);
            return this;
        },
        stop: function() {
            a.removeFromArray(this.R.animations, this.an_translate);
            a.removeFromArray(this.R.animations, this.an_y);
            a.removeFromArray(this.R.animations, this.an_x);
        },
        length: function() {
            return this.node.childNodes.length;
        },
        gradient: function(a, b, c) {
            this.R.gradient(this, a, b, c);
        },
        pattern: function(a, b, c) {
            a && this.R.pattern(this, a, b, c);
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.VMLRenderer = a.Class({
        construct: function(a, b) {
            this.chart = b;
            this.D = a;
            this.cNames = {
                circle: "oval",
                ellipse: "oval",
                rect: "roundrect",
                path: "shape"
            };
            this.styleMap = {
                x: "left",
                y: "top",
                width: "width",
                height: "height",
                "font-family": "fontFamily",
                "font-size": "fontSize",
                visibility: "visibility"
            };
        },
        create: function(a, b) {
            var c;
            if ("group" == b) c = document.createElement("div"), a.type = "div"; else if ("text" == b) c = document.createElement("div"), 
            a.type = "text"; else if ("image" == b) c = document.createElement("img"), a.type = "image"; else {
                a.type = "shape";
                a.shapeType = this.cNames[b];
                c = document.createElement("amvml:" + this.cNames[b]);
                var d = document.createElement("amvml:stroke");
                c.appendChild(d);
                a.stroke = d;
                var e = document.createElement("amvml:fill");
                c.appendChild(e);
                a.fill = e;
                e.className = "amvml";
                d.className = "amvml";
                c.className = "amvml";
            }
            c.style.position = "absolute";
            c.style.top = 0;
            c.style.left = 0;
            return c;
        },
        path: function(a, b) {
            a.node.setAttribute("src", b);
        },
        setAttr: function(b, c, d) {
            if (void 0 !== d) {
                var e;
                8 === document.documentMode && (e = !0);
                var f = b.node, g = b.type, h = f.style;
                "r" == c && (h.width = 2 * d, h.height = 2 * d);
                "oval" == b.shapeType && ("rx" == c && (h.width = 2 * d), "ry" == c && (h.height = 2 * d));
                "roundrect" == b.shapeType && ("width" != c && "height" != c || --d);
                "cursor" == c && (h.cursor = d);
                "cx" == c && (h.left = d - a.removePx(h.width) / 2);
                "cy" == c && (h.top = d - a.removePx(h.height) / 2);
                var i = this.styleMap[c];
                "width" == i && 0 > d && (d = 0);
                void 0 !== i && (h[i] = d);
                "text" == g && ("text-anchor" == c && (b.anchor = d, i = f.clientWidth, "end" == d && (h.marginLeft = -i + "px"), 
                "middle" == d && (h.marginLeft = -(i / 2) + "px", h.textAlign = "center"), "start" == d && (h.marginLeft = "0px")), 
                "fill" == c && (h.color = d), "font-weight" == c && (h.fontWeight = d));
                if (h = b.children) for (i = 0; i < h.length; i++) h[i].setAttr(c, d);
                if ("shape" == g) {
                    "cs" == c && (f.style.width = "100px", f.style.height = "100px", f.setAttribute("coordsize", d));
                    "d" == c && f.setAttribute("path", this.svgPathToVml(d));
                    "dd" == c && f.setAttribute("path", d);
                    g = b.stroke;
                    b = b.fill;
                    "stroke" == c && (e ? g.color = d : g.setAttribute("color", d));
                    "stroke-width" == c && (e ? g.weight = d : g.setAttribute("weight", d));
                    "stroke-opacity" == c && (e ? g.opacity = d : g.setAttribute("opacity", d));
                    "stroke-dasharray" == c && (h = "solid", 0 < d && 3 > d && (h = "dot"), 3 <= d && 6 >= d && (h = "dash"), 
                    6 < d && (h = "longdash"), e ? g.dashstyle = h : g.setAttribute("dashstyle", h));
                    if ("fill-opacity" == c || "opacity" == c) 0 === d ? e ? b.on = !1 : b.setAttribute("on", !1) : e ? b.opacity = d : b.setAttribute("opacity", d);
                    "fill" == c && (e ? b.color = d : b.setAttribute("color", d));
                    "rx" == c && (e ? f.arcSize = d + "%" : f.setAttribute("arcsize", d + "%"));
                }
            }
        },
        attr: function(a, b) {
            for (var c in b) b.hasOwnProperty(c) && this.setAttr(a, c, b[c]);
        },
        text: function(b, c, d) {
            var e = new a.AmDObject("text", this.D), f = e.node;
            f.style.whiteSpace = "pre";
            f.innerHTML = b;
            this.D.addToContainer(f, d);
            this.attr(e, c);
            return e;
        },
        getBBox: function(a) {
            return this.getBox(a.node);
        },
        getBox: function(a) {
            var b = a.offsetLeft, c = a.offsetTop, d = a.offsetWidth, e = a.offsetHeight, f;
            if (a.hasChildNodes()) {
                var g, h, i;
                for (i = 0; i < a.childNodes.length; i++) {
                    f = this.getBox(a.childNodes[i]);
                    var j = f.x;
                    isNaN(j) || (isNaN(g) ? g = j : j < g && (g = j));
                    var k = f.y;
                    isNaN(k) || (isNaN(h) ? h = k : k < h && (h = k));
                    j = f.width + j;
                    isNaN(j) || (d = Math.max(d, j));
                    f = f.height + k;
                    isNaN(f) || (e = Math.max(e, f));
                }
                0 > g && (b += g);
                0 > h && (c += h);
            }
            return {
                x: b,
                y: c,
                width: d,
                height: e
            };
        },
        setText: function(a, b) {
            var c = a.node;
            c && (c.innerHTML = b);
            this.setAttr(a, "text-anchor", a.anchor);
        },
        addListener: function(a, b, c) {
            a.node["on" + b] = c;
        },
        move: function(b, c, d) {
            var e = b.node, f = e.style;
            "text" == b.type && (d -= a.removePx(f.fontSize) / 2 - 1);
            "oval" == b.shapeType && (c -= a.removePx(f.width) / 2, d -= a.removePx(f.height) / 2);
            b = b.bw;
            isNaN(b) || (c -= b, d -= b);
            isNaN(c) || isNaN(d) || (e.style.left = c + "px", e.style.top = d + "px");
        },
        svgPathToVml: function(a) {
            var b = a.split(" ");
            a = "";
            var c, d = Math.round, e;
            for (e = 0; e < b.length; e++) {
                var f = b[e], g = f.substring(0, 1), f = f.substring(1), h = f.split(","), i = d(h[0]) + "," + d(h[1]);
                "M" == g && (a += " m " + i);
                "L" == g && (a += " l " + i);
                "Z" == g && (a += " x e");
                if ("Q" == g) {
                    var j = c.length, k = c[j - 1], l = h[0], m = h[1], i = h[2], n = h[3];
                    c = d(c[j - 2] / 3 + 2 / 3 * l);
                    k = d(k / 3 + 2 / 3 * m);
                    l = d(2 / 3 * l + i / 3);
                    m = d(2 / 3 * m + n / 3);
                    a += " c " + c + "," + k + "," + l + "," + m + "," + i + "," + n;
                }
                "A" == g && (a += " wa " + f);
                "B" == g && (a += " at " + f);
                c = h;
            }
            return a;
        },
        animate: function(a, b, c, d, e) {
            var f = a.node, g = this.chart;
            a.animationFinished = !1;
            if ("translate" == b) {
                b = c.split(",");
                c = b[1];
                var h = f.offsetTop;
                g.animate(a, "left", f.offsetLeft, b[0], d, e, "px");
                g.animate(a, "top", h, c, d, e, "px");
            }
        },
        clipRect: function(a, b, c, d, e) {
            a = a.node;
            0 === b && 0 === c ? (a.style.width = d + "px", a.style.height = e + "px", a.style.overflow = "hidden") : a.style.clip = "rect(" + c + "px " + (b + d) + "px " + (c + e) + "px " + b + "px)";
        },
        rotate: function(b, c, d) {
            if (0 !== Number(c)) {
                var e = b.node;
                b = e.style;
                d || (d = this.getBGColor(e.parentNode));
                b.backgroundColor = d;
                b.paddingLeft = 1;
                d = c * Math.PI / 180;
                var f = Math.cos(d), g = Math.sin(d), h = a.removePx(b.left), i = a.removePx(b.top), j = e.offsetWidth, e = e.offsetHeight;
                c /= Math.abs(c);
                b.left = h + j / 2 - j / 2 * Math.cos(d) - c * e / 2 * Math.sin(d) + 3;
                b.top = i - c * j / 2 * Math.sin(d) + c * e / 2 * Math.sin(d);
                b.cssText = b.cssText + "; filter:progid:DXImageTransform.Microsoft.Matrix(M11='" + f + "', M12='" + -g + "', M21='" + g + "', M22='" + f + "', sizingmethod='auto expand');";
            }
        },
        getBGColor: function(a) {
            var b = "#FFFFFF";
            if (a.style) {
                var c = a.style.backgroundColor;
                "" !== c ? b = c : a.parentNode && (b = this.getBGColor(a.parentNode));
            }
            return b;
        },
        set: function(b) {
            var c = new a.AmDObject("group", this.D);
            this.D.container.appendChild(c.node);
            if (b) {
                var d;
                for (d = 0; d < b.length; d++) c.push(b[d]);
            }
            return c;
        },
        gradient: function(a, b, c, d) {
            var e = "";
            "radialGradient" == b && (b = "gradientradial", c.reverse());
            "linearGradient" == b && (b = "gradient");
            var f;
            for (f = 0; f < c.length; f++) e += Math.round(100 * f / (c.length - 1)) + "% " + c[f], 
            f < c.length - 1 && (e += ",");
            a = a.fill;
            90 == d ? d = 0 : 270 == d ? d = 180 : 180 == d ? d = 90 : 0 === d && (d = 270);
            8 === document.documentMode ? (a.type = b, a.angle = d) : (a.setAttribute("type", b), 
            a.setAttribute("angle", d));
            e && (a.colors.value = e);
        },
        remove: function(a) {
            a.clipPath && this.D.remove(a.clipPath);
            this.D.remove(a.node);
        },
        disableSelection: function(a) {
            a.onselectstart = function() {
                return !1;
            };
            a.style.cursor = "default";
        },
        pattern: function(b, c, d, e) {
            d = b.node;
            b = b.fill;
            var f = "none";
            c.color && (f = c.color);
            d.fillColor = f;
            c = c.url;
            a.isAbsolute(c) || (c = e + c);
            8 === document.documentMode ? (b.type = "tile", b.src = c) : (b.setAttribute("type", "tile"), 
            b.setAttribute("src", c));
        },
        update: function() {}
    });
}();

!function() {
    var a = window.AmCharts;
    a.SVGRenderer = a.Class({
        construct: function(a) {
            this.D = a;
            this.animations = [];
        },
        create: function(b, c) {
            return document.createElementNS(a.SVG_NS, c);
        },
        attr: function(a, b) {
            for (var c in b) b.hasOwnProperty(c) && this.setAttr(a, c, b[c]);
        },
        setAttr: function(a, b, c) {
            void 0 !== c && a.node.setAttribute(b, c);
        },
        animate: function(b, c, d, e, f) {
            b.animationFinished = !1;
            var g = b.node;
            b["an_" + c] && a.removeFromArray(this.animations, b["an_" + c]);
            "translate" == c ? (g = (g = g.getAttribute("transform")) ? String(g).substring(10, g.length - 1) : "0,0", 
            g = g.split(", ").join(" "), g = g.split(" ").join(","), 0 === g && (g = "0,0")) : g = Number(g.getAttribute(c));
            d = {
                obj: b,
                frame: 0,
                attribute: c,
                from: g,
                to: d,
                time: e,
                effect: f
            };
            this.animations.push(d);
            b["an_" + c] = d;
        },
        update: function() {
            var b, c = this.animations;
            for (b = c.length - 1; 0 <= b; b--) {
                var d = c[b], e = d.time * a.updateRate, f = d.frame + 1, g = d.obj, h = d.attribute, i, j, k;
                f <= e ? (d.frame++, "translate" == h ? (i = d.from.split(","), h = Number(i[0]), 
                i = Number(i[1]), isNaN(i) && (i = 0), j = d.to.split(","), k = Number(j[0]), j = Number(j[1]), 
                k = 0 === k - h ? k : Math.round(a[d.effect](0, f, h, k - h, e)), d = 0 === j - i ? j : Math.round(a[d.effect](0, f, i, j - i, e)), 
                h = "transform", d = "translate(" + k + "," + d + ")") : (j = Number(d.from), i = Number(d.to), 
                k = i - j, d = a[d.effect](0, f, j, k, e), isNaN(d) && (d = i), 0 === k && this.animations.splice(b, 1)), 
                this.setAttr(g, h, d)) : ("translate" == h ? (j = d.to.split(","), k = Number(j[0]), 
                j = Number(j[1]), g.translate(k, j)) : (i = Number(d.to), this.setAttr(g, h, i)), 
                g.animationFinished = !0, this.animations.splice(b, 1));
            }
        },
        getBBox: function(a) {
            if (a = a.node) try {
                return a.getBBox();
            } catch (b) {}
            return {
                width: 0,
                height: 0,
                x: 0,
                y: 0
            };
        },
        path: function(b, c) {
            b.node.setAttributeNS(a.SVG_XLINK, "xlink:href", c);
        },
        clipRect: function(b, c, d, e, f) {
            var g = b.node, h = b.clipPath;
            h && this.D.remove(h);
            var i = g.parentNode;
            i && (g = document.createElementNS(a.SVG_NS, "clipPath"), h = a.getUniqueId(), g.setAttribute("id", h), 
            this.D.rect(c, d, e, f, 0, 0, g), i.appendChild(g), c = "#", a.baseHref && !a.isIE && (c = this.removeTarget(window.location.href) + c), 
            this.setAttr(b, "clip-path", "url(" + c + h + ")"), this.clipPathC++, b.clipPath = g);
        },
        text: function(b, c, d) {
            var e = new a.AmDObject("text", this.D);
            b = String(b).split("\n");
            var f = a.removePx(c["font-size"]), g;
            for (g = 0; g < b.length; g++) {
                var h = this.create(null, "tspan");
                h.appendChild(document.createTextNode(b[g]));
                h.setAttribute("y", (f + 2) * g + Math.round(f / 2));
                h.setAttribute("x", 0);
                e.node.appendChild(h);
            }
            e.node.setAttribute("y", Math.round(f / 2));
            this.attr(e, c);
            this.D.addToContainer(e.node, d);
            return e;
        },
        setText: function(a, b) {
            var c = a.node;
            c && (c.removeChild(c.firstChild), c.appendChild(document.createTextNode(b)));
        },
        move: function(a, b, c, d) {
            isNaN(b) && (b = 0);
            isNaN(c) && (c = 0);
            b = "translate(" + b + "," + c + ")";
            d && (b = b + " scale(" + d + ")");
            this.setAttr(a, "transform", b);
        },
        rotate: function(a, b) {
            var c = a.node.getAttribute("transform"), d = "rotate(" + b + ")";
            c && (d = c + " " + d);
            this.setAttr(a, "transform", d);
        },
        set: function(b) {
            var c = new a.AmDObject("g", this.D);
            this.D.container.appendChild(c.node);
            if (b) {
                var d;
                for (d = 0; d < b.length; d++) c.push(b[d]);
            }
            return c;
        },
        addListener: function(a, b, c) {
            a.node["on" + b] = c;
        },
        gradient: function(b, c, d, e) {
            var f = b.node, g = b.grad;
            g && this.D.remove(g);
            c = document.createElementNS(a.SVG_NS, c);
            g = a.getUniqueId();
            c.setAttribute("id", g);
            if (!isNaN(e)) {
                var h = 0, i = 0, j = 0, k = 0;
                90 == e ? j = 100 : 270 == e ? k = 100 : 180 == e ? h = 100 : 0 === e && (i = 100);
                c.setAttribute("x1", h + "%");
                c.setAttribute("x2", i + "%");
                c.setAttribute("y1", j + "%");
                c.setAttribute("y2", k + "%");
            }
            for (e = 0; e < d.length; e++) h = document.createElementNS(a.SVG_NS, "stop"), i = 100 * e / (d.length - 1), 
            0 === e && (i = 0), h.setAttribute("offset", i + "%"), h.setAttribute("stop-color", d[e]), 
            c.appendChild(h);
            f.parentNode.appendChild(c);
            d = "#";
            a.baseHref && !a.isIE && (d = this.removeTarget(window.location.href) + d);
            f.setAttribute("fill", "url(" + d + g + ")");
            b.grad = c;
        },
        removeTarget: function(a) {
            return a.split("#")[0];
        },
        pattern: function(b, c, d, e) {
            var f = b.node;
            isNaN(d) && (d = 1);
            var g = b.patternNode;
            g && this.D.remove(g);
            var g = document.createElementNS(a.SVG_NS, "pattern"), h = a.getUniqueId(), i = c;
            c.url && (i = c.url);
            a.isAbsolute(i) || -1 != i.indexOf("data:image") || (i = e + i);
            e = Number(c.width);
            isNaN(e) && (e = 4);
            var j = Number(c.height);
            isNaN(j) && (j = 4);
            e /= d;
            j /= d;
            d = c.x;
            isNaN(d) && (d = 0);
            var k = -Math.random() * Number(c.randomX);
            isNaN(k) || (d = k);
            k = c.y;
            isNaN(k) && (k = 0);
            var l = -Math.random() * Number(c.randomY);
            isNaN(l) || (k = l);
            g.setAttribute("id", h);
            g.setAttribute("width", e);
            g.setAttribute("height", j);
            g.setAttribute("patternUnits", "userSpaceOnUse");
            g.setAttribute("xlink:href", i);
            c.color && (l = document.createElementNS(a.SVG_NS, "rect"), l.setAttributeNS(null, "height", e), 
            l.setAttributeNS(null, "width", j), l.setAttributeNS(null, "fill", c.color), g.appendChild(l));
            this.D.image(i, 0, 0, e, j, g).translate(d, k);
            i = "#";
            a.baseHref && !a.isIE && (i = this.removeTarget(window.location.href) + i);
            f.setAttribute("fill", "url(" + i + h + ")");
            b.patternNode = g;
            f.parentNode.appendChild(g);
        },
        remove: function(a) {
            a.clipPath && this.D.remove(a.clipPath);
            a.grad && this.D.remove(a.grad);
            a.patternNode && this.D.remove(a.patternNode);
            this.D.remove(a.node);
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.AmLegend = a.Class({
        construct: function(b) {
            this.enabled = !0;
            this.cname = "AmLegend";
            this.createEvents("rollOverMarker", "rollOverItem", "rollOutMarker", "rollOutItem", "showItem", "hideItem", "clickMarker", "rollOverItem", "rollOutItem", "clickLabel");
            this.position = "bottom";
            this.borderColor = this.color = "#000000";
            this.borderAlpha = 0;
            this.markerLabelGap = 5;
            this.verticalGap = 10;
            this.align = "left";
            this.horizontalGap = 0;
            this.spacing = 10;
            this.markerDisabledColor = "#AAB3B3";
            this.markerType = "square";
            this.markerSize = 16;
            this.markerBorderThickness = this.markerBorderAlpha = 1;
            this.marginBottom = this.marginTop = 0;
            this.marginLeft = this.marginRight = 20;
            this.autoMargins = !0;
            this.valueWidth = 50;
            this.switchable = !0;
            this.switchType = "x";
            this.switchColor = "#FFFFFF";
            this.rollOverColor = "#CC0000";
            this.reversedOrder = !1;
            this.labelText = "[[title]]";
            this.valueText = "[[value]]";
            this.useMarkerColorForLabels = !1;
            this.rollOverGraphAlpha = 1;
            this.textClickEnabled = !1;
            this.equalWidths = !0;
            this.backgroundColor = "#FFFFFF";
            this.backgroundAlpha = 0;
            this.useGraphSettings = !1;
            this.showEntries = !0;
            a.applyTheme(this, b, this.cname);
        },
        setData: function(a) {
            this.legendData = a;
            this.invalidateSize();
        },
        invalidateSize: function() {
            this.destroy();
            this.entries = [];
            this.valueLabels = [];
            var b = this.legendData;
            this.enabled && (a.ifArray(b) || a.ifArray(this.data)) && this.drawLegend();
        },
        drawLegend: function() {
            var b = this.chart, c = this.position, d = this.width, e = b.divRealWidth, f = b.divRealHeight, g = this.div, h = this.legendData;
            this.data && (h = this.data);
            isNaN(this.fontSize) && (this.fontSize = b.fontSize);
            this.maxColumnsReal = this.maxColumns;
            if ("right" == c || "left" == c) this.maxColumnsReal = 1, this.autoMargins && (this.marginLeft = this.marginRight = 10); else if (this.autoMargins) {
                this.marginRight = b.marginRight;
                this.marginLeft = b.marginLeft;
                var i = b.autoMarginOffset;
                "bottom" == c ? (this.marginBottom = i, this.marginTop = 0) : (this.marginTop = i, 
                this.marginBottom = 0);
            }
            d = void 0 !== d ? a.toCoordinate(d, e) : "right" != c && "left" != c ? b.realWidth : 0 < this.ieW ? this.ieW : b.realWidth;
            "outside" == c ? (d = g.offsetWidth, f = g.offsetHeight, g.clientHeight && (d = g.clientWidth, 
            f = g.clientHeight)) : (isNaN(d) || (g.style.width = d + "px"), g.className = "amChartsLegend " + b.classNamePrefix + "-legend-div");
            this.divWidth = d;
            (c = this.container) ? (c.container.innerHTML = "", g.appendChild(c.container), 
            c.width = d, c.height = f, c.setSize(d, f), c.addDefs(b)) : c = new a.AmDraw(g, d, f, b);
            this.container = c;
            this.lx = 0;
            this.ly = 8;
            f = this.markerSize;
            f > this.fontSize && (this.ly = f / 2 - 1);
            0 < f && (this.lx += f + this.markerLabelGap);
            this.titleWidth = 0;
            if (f = this.title) f = a.text(this.container, f, this.color, b.fontFamily, this.fontSize, "start", !0), 
            a.setCN(b, f, "legend-title"), f.translate(this.marginLeft, this.marginTop + this.verticalGap + this.ly + 1), 
            b = f.getBBox(), this.titleWidth = b.width + 15, this.titleHeight = b.height + 6;
            this.index = this.maxLabelWidth = 0;
            if (this.showEntries) {
                for (b = 0; b < h.length; b++) this.createEntry(h[b]);
                for (b = this.index = 0; b < h.length; b++) this.createValue(h[b]);
            }
            this.arrangeEntries();
            this.updateValues();
        },
        arrangeEntries: function() {
            var b = this.position, c = this.marginLeft + this.titleWidth, d = this.marginRight, e = this.marginTop, f = this.marginBottom, g = this.horizontalGap, h = this.div, i = this.divWidth, j = this.maxColumnsReal, k = this.verticalGap, l = this.spacing, m = i - d - c, n = 0, o = 0, p = this.container;
            this.set && this.set.remove();
            var q = p.set();
            this.set = q;
            var r = p.set();
            q.push(r);
            var s = this.entries, t, u;
            for (u = 0; u < s.length; u++) {
                t = s[u].getBBox();
                var v = t.width;
                v > n && (n = v);
                t = t.height;
                t > o && (o = t);
            }
            var v = o = 0, w = g, x = 0, y = 0;
            for (u = 0; u < s.length; u++) {
                var z = s[u];
                this.reversedOrder && (z = s[s.length - u - 1]);
                t = z.getBBox();
                var A;
                this.equalWidths ? A = v * (n + l + this.markerLabelGap) : (A = w, w = w + t.width + g + l);
                t.height > y && (y = t.height);
                A + t.width > m && 0 < u && 0 !== v && (o++, A = v = 0, w = A + t.width + g + l, 
                x = x + y + k, y = 0);
                z.translate(A, x);
                v++;
                !isNaN(j) && v >= j && (v = 0, o++, x = x + y + k, w = g, y = 0);
                r.push(z);
            }
            t = r.getBBox();
            j = t.height + 2 * k - 1;
            "left" == b || "right" == b ? (l = t.width + 2 * g, i = l + c + d, h.style.width = i + "px", 
            this.ieW = i) : l = i - c - d - 1;
            d = a.polygon(this.container, [ 0, l, l, 0 ], [ 0, 0, j, j ], this.backgroundColor, this.backgroundAlpha, 1, this.borderColor, this.borderAlpha);
            a.setCN(this.chart, d, "legend-bg");
            q.push(d);
            q.translate(c, e);
            d.toBack();
            c = g;
            if ("top" == b || "bottom" == b || "absolute" == b || "outside" == b) "center" == this.align ? c = g + (l - t.width) / 2 : "right" == this.align && (c = g + l - t.width);
            r.translate(c, k + 1);
            this.titleHeight > j && (j = this.titleHeight);
            b = j + e + f + 1;
            0 > b && (b = 0);
            b > this.chart.divRealHeight && (h.style.top = "0px");
            h.style.height = Math.round(b) + "px";
            p.setSize(this.divWidth, b);
        },
        createEntry: function(b) {
            if (!1 !== b.visibleInLegend && !b.hideFromLegend) {
                var c = this.chart, d = b.markerType;
                b.legendEntryWidth = this.markerSize;
                d || (d = this.markerType);
                var e = b.color, f = b.alpha;
                b.legendKeyColor && (e = b.legendKeyColor());
                b.legendKeyAlpha && (f = b.legendKeyAlpha());
                var g;
                !0 === b.hidden && (g = e = this.markerDisabledColor);
                var h = b.pattern, i = b.customMarker;
                i || (i = this.customMarker);
                var j = this.container, k = this.markerSize, l = 0, m = 0, n = k / 2;
                if (this.useGraphSettings) {
                    d = b.type;
                    this.switchType = void 0;
                    if ("line" == d || "step" == d || "smoothedLine" == d || "ohlc" == d) h = j.set(), 
                    b.hidden || (e = b.lineColorR, g = b.bulletBorderColorR), l = a.line(j, [ 0, 2 * k ], [ k / 2, k / 2 ], e, b.lineAlpha, b.lineThickness, b.dashLength), 
                    a.setCN(c, l, "graph-stroke"), h.push(l), b.bullet && (b.hidden || (e = b.bulletColorR), 
                    l = a.bullet(j, b.bullet, b.bulletSize, e, b.bulletAlpha, b.bulletBorderThickness, g, b.bulletBorderAlpha)) && (a.setCN(c, l, "graph-bullet"), 
                    l.translate(k + 1, k / 2), h.push(l)), n = 0, l = k, m = k / 3; else {
                        var o;
                        b.getGradRotation && (o = b.getGradRotation(), 0 === o && (o = 180));
                        l = b.fillColorsR;
                        !0 === b.hidden && (l = e);
                        if (h = this.createMarker("rectangle", l, b.fillAlphas, b.lineThickness, e, b.lineAlpha, o, h, b.dashLength)) n = k, 
                        h.translate(n, k / 2);
                        l = k;
                    }
                    a.setCN(c, h, "graph-" + d);
                    a.setCN(c, h, "graph-" + b.id);
                } else if (i) h = j.image(i, 0, 0, k, k); else {
                    var p;
                    isNaN(this.gradientRotation) || (p = 180 + this.gradientRotation);
                    (h = this.createMarker(d, e, f, void 0, void 0, void 0, p, h)) && h.translate(k / 2, k / 2);
                }
                a.setCN(c, h, "legend-marker");
                this.addListeners(h, b);
                j = j.set([ h ]);
                this.switchable && b.switchable && j.setAttr("cursor", "pointer");
                void 0 !== b.id && a.setCN(c, j, "legend-item-" + b.id);
                a.setCN(c, j, b.className, !0);
                g = this.switchType;
                var q;
                g && "none" != g && 0 < k && ("x" == g ? (q = this.createX(), q.translate(k / 2, k / 2)) : q = this.createV(), 
                q.dItem = b, !0 !== b.hidden ? "x" == g ? q.hide() : q.show() : "x" != g && q.hide(), 
                this.switchable || q.hide(), this.addListeners(q, b), b.legendSwitch = q, j.push(q), 
                a.setCN(c, q, "legend-switch"));
                g = this.color;
                b.showBalloon && this.textClickEnabled && void 0 !== this.selectedColor && (g = this.selectedColor);
                this.useMarkerColorForLabels && (g = e);
                !0 === b.hidden && (g = this.markerDisabledColor);
                e = a.massReplace(this.labelText, {
                    "[[title]]": b.title
                });
                o = this.fontSize;
                h && (k <= o && (k = k / 2 + this.ly - o / 2 + (o + 2 - k) / 2 - m, h.translate(n, k), 
                q && q.translate(q.x, k)), b.legendEntryWidth = h.getBBox().width);
                var r;
                e && (e = a.fixBrakes(e), b.legendTextReal = e, r = this.labelWidth, r = isNaN(r) ? a.text(this.container, e, g, c.fontFamily, o, "start") : a.wrappedText(this.container, e, g, c.fontFamily, o, "start", !1, r, 0), 
                a.setCN(c, r, "legend-label"), r.translate(this.lx + l, this.ly), j.push(r), c = r.getBBox().width, 
                this.maxLabelWidth < c && (this.maxLabelWidth = c));
                this.entries[this.index] = j;
                b.legendEntry = this.entries[this.index];
                b.legendLabel = r;
                this.index++;
            }
        },
        addListeners: function(a, b) {
            var c = this;
            a && a.mouseover(function(a) {
                c.rollOverMarker(b, a);
            }).mouseout(function(a) {
                c.rollOutMarker(b, a);
            }).click(function(a) {
                c.clickMarker(b, a);
            });
        },
        rollOverMarker: function(a, b) {
            this.switchable && this.dispatch("rollOverMarker", a, b);
            this.dispatch("rollOverItem", a, b);
        },
        rollOutMarker: function(a, b) {
            this.switchable && this.dispatch("rollOutMarker", a, b);
            this.dispatch("rollOutItem", a, b);
        },
        clickMarker: function(a, b) {
            this.switchable && (!0 === a.hidden ? this.dispatch("showItem", a, b) : this.dispatch("hideItem", a, b));
            this.dispatch("clickMarker", a, b);
        },
        rollOverLabel: function(a, b) {
            a.hidden || (this.textClickEnabled && a.legendLabel && a.legendLabel.attr({
                fill: this.rollOverColor
            }), this.dispatch("rollOverItem", a, b));
        },
        rollOutLabel: function(a, b) {
            if (!a.hidden) {
                if (this.textClickEnabled && a.legendLabel) {
                    var c = this.color;
                    void 0 !== this.selectedColor && a.showBalloon && (c = this.selectedColor);
                    this.useMarkerColorForLabels && (c = a.lineColor, void 0 === c && (c = a.color));
                    a.legendLabel.attr({
                        fill: c
                    });
                }
                this.dispatch("rollOutItem", a, b);
            }
        },
        clickLabel: function(a, b) {
            this.textClickEnabled ? a.hidden || this.dispatch("clickLabel", a, b) : this.switchable && (!0 === a.hidden ? this.dispatch("showItem", a, b) : this.dispatch("hideItem", a, b));
        },
        dispatch: function(a, b, c) {
            a = {
                type: a,
                dataItem: b,
                target: this,
                event: c,
                chart: this.chart
            };
            this.chart && this.chart.handleLegendEvent(a);
            this.fire(a);
        },
        createValue: function(b) {
            var c = this, d = c.fontSize, e = c.chart;
            if (!1 !== b.visibleInLegend && !b.hideFromLegend) {
                var f = c.maxLabelWidth;
                c.forceWidth && (f = c.labelWidth);
                c.equalWidths || (c.valueAlign = "left");
                "left" == c.valueAlign && (f = b.legendEntry.getBBox().width);
                var g = f;
                if (c.valueText && 0 < c.valueWidth) {
                    var h = c.color;
                    c.useMarkerColorForValues && (h = b.color, b.legendKeyColor && (h = b.legendKeyColor()));
                    !0 === b.hidden && (h = c.markerDisabledColor);
                    var i = c.valueText, f = f + c.lx + c.markerLabelGap + c.valueWidth, j = "end";
                    "left" == c.valueAlign && (f -= c.valueWidth, j = "start");
                    h = a.text(c.container, i, h, c.chart.fontFamily, d, j);
                    a.setCN(e, h, "legend-value");
                    h.translate(f, c.ly);
                    c.entries[c.index].push(h);
                    g += c.valueWidth + 2 * c.markerLabelGap;
                    h.dItem = b;
                    c.valueLabels.push(h);
                }
                c.index++;
                e = c.markerSize;
                e < d + 7 && (e = d + 7, a.VML && (e += 3));
                d = c.container.rect(b.legendEntryWidth, 0, g, e, 0, 0).attr({
                    stroke: "none",
                    fill: "#fff",
                    "fill-opacity": .005
                });
                d.dItem = b;
                c.entries[c.index - 1].push(d);
                d.mouseover(function(a) {
                    c.rollOverLabel(b, a);
                }).mouseout(function(a) {
                    c.rollOutLabel(b, a);
                }).click(function(a) {
                    c.clickLabel(b, a);
                });
            }
        },
        createV: function() {
            var b = this.markerSize;
            return a.polygon(this.container, [ b / 5, b / 2, b - b / 5, b / 2 ], [ b / 3, b - b / 5, b / 5, b / 1.7 ], this.switchColor);
        },
        createX: function() {
            var b = (this.markerSize - 4) / 2, c = {
                stroke: this.switchColor,
                "stroke-width": 3
            }, d = this.container, e = a.line(d, [ -b, b ], [ -b, b ]).attr(c), b = a.line(d, [ -b, b ], [ b, -b ]).attr(c);
            return this.container.set([ e, b ]);
        },
        createMarker: function(b, c, d, e, f, g, h, i, j) {
            var k = this.markerSize, l = this.container;
            f || (f = this.markerBorderColor);
            f || (f = c);
            isNaN(e) && (e = this.markerBorderThickness);
            isNaN(g) && (g = this.markerBorderAlpha);
            return a.bullet(l, b, k, c, d, e, f, g, k, h, i, this.chart.path, j);
        },
        validateNow: function() {
            this.invalidateSize();
        },
        updateValues: function() {
            var b = this.valueLabels, c = this.chart, d, e = this.data;
            if (b) for (d = 0; d < b.length; d++) {
                var f = b[d], g = f.dItem, h = " ";
                if (e) g.value ? f.text(g.value) : f.text(""); else {
                    var i;
                    if (void 0 !== g.type) {
                        i = g.currentDataItem;
                        var j = this.periodValueText;
                        g.legendPeriodValueText && (j = g.legendPeriodValueText);
                        i ? (h = this.valueText, g.legendValueText && (h = g.legendValueText), h = c.formatString(h, i)) : j && c.formatPeriodString && (j = a.massReplace(j, {
                            "[[title]]": g.title
                        }), h = c.formatPeriodString(j, g));
                    } else h = c.formatString(this.valueText, g);
                    if (j = this.valueFunction) i && (g = i), h = j(g, h);
                    f.text(h);
                }
            }
        },
        renderFix: function() {
            if (!a.VML && this.enabled) {
                var b = this.container;
                b && b.renderFix();
            }
        },
        destroy: function() {
            this.div.innerHTML = "";
            a.remove(this.set);
        }
    });
}();

!function() {
    var a = window.AmCharts;
    a.formatMilliseconds = function(a, b) {
        if (-1 != a.indexOf("fff")) {
            var c = b.getMilliseconds(), d = String(c);
            10 > c && (d = "00" + c);
            10 <= c && 100 > c && (d = "0" + c);
            a = a.replace(/fff/g, d);
        }
        return a;
    };
    a.extractPeriod = function(b) {
        var c = a.stripNumbers(b), d = 1;
        c != b && (d = Number(b.slice(0, b.indexOf(c))));
        return {
            period: c,
            count: d
        };
    };
    a.getDate = function(b, c, d) {
        return b instanceof Date ? a.newDate(b, d) : c && isNaN(b) ? a.stringToDate(b, c) : new Date(b);
    };
    a.daysInMonth = function(a) {
        return new Date(a.getYear(), a.getMonth() + 1, 0).getDate();
    };
    a.newDate = function(a, b) {
        return b && -1 == b.indexOf("fff") ? new Date(a) : new Date(a.getFullYear(), a.getMonth(), a.getDate(), a.getHours(), a.getMinutes(), a.getSeconds(), a.getMilliseconds());
    };
    a.resetDateToMin = function(b, c, d, e) {
        void 0 === e && (e = 1);
        var f, g, h, i, j, k, l;
        a.useUTC ? (f = b.getUTCFullYear(), g = b.getUTCMonth(), h = b.getUTCDate(), i = b.getUTCHours(), 
        j = b.getUTCMinutes(), k = b.getUTCSeconds(), l = b.getUTCMilliseconds(), b = b.getUTCDay()) : (f = b.getFullYear(), 
        g = b.getMonth(), h = b.getDate(), i = b.getHours(), j = b.getMinutes(), k = b.getSeconds(), 
        l = b.getMilliseconds(), b = b.getDay());
        switch (c) {
          case "YYYY":
            f = Math.floor(f / d) * d;
            g = 0;
            h = 1;
            l = k = j = i = 0;
            break;

          case "MM":
            g = Math.floor(g / d) * d;
            h = 1;
            l = k = j = i = 0;
            break;

          case "WW":
            h = b >= e ? h - b + e : h - (7 + b) + e;
            l = k = j = i = 0;
            break;

          case "DD":
            l = k = j = i = 0;
            break;

          case "hh":
            i = Math.floor(i / d) * d;
            l = k = j = 0;
            break;

          case "mm":
            j = Math.floor(j / d) * d;
            l = k = 0;
            break;

          case "ss":
            k = Math.floor(k / d) * d;
            l = 0;
            break;

          case "fff":
            l = Math.floor(l / d) * d;
        }
        a.useUTC ? (b = new Date(), b.setUTCFullYear(f, g, h), b.setUTCHours(i, j, k, l)) : b = new Date(f, g, h, i, j, k, l);
        return b;
    };
    a.getPeriodDuration = function(a, b) {
        void 0 === b && (b = 1);
        var c;
        switch (a) {
          case "YYYY":
            c = 316224e5;
            break;

          case "MM":
            c = 26784e5;
            break;

          case "WW":
            c = 6048e5;
            break;

          case "DD":
            c = 864e5;
            break;

          case "hh":
            c = 36e5;
            break;

          case "mm":
            c = 6e4;
            break;

          case "ss":
            c = 1e3;
            break;

          case "fff":
            c = 1;
        }
        return c * b;
    };
    a.intervals = {
        s: {
            nextInterval: "ss",
            contains: 1e3
        },
        ss: {
            nextInterval: "mm",
            contains: 60,
            count: 0
        },
        mm: {
            nextInterval: "hh",
            contains: 60,
            count: 1
        },
        hh: {
            nextInterval: "DD",
            contains: 24,
            count: 2
        },
        DD: {
            nextInterval: "",
            contains: 1/0,
            count: 3
        }
    };
    a.getMaxInterval = function(b, c) {
        var d = a.intervals;
        return b >= d[c].contains ? (b = Math.round(b / d[c].contains), c = d[c].nextInterval, 
        a.getMaxInterval(b, c)) : "ss" == c ? d[c].nextInterval : c;
    };
    a.dayNames = "Sunday Monday Tuesday Wednesday Thursday Friday Saturday".split(" ");
    a.shortDayNames = "Sun Mon Tue Wed Thu Fri Sat".split(" ");
    a.monthNames = "January February March April May June July August September October November December".split(" ");
    a.shortMonthNames = "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec".split(" ");
    a.getWeekNumber = function(a) {
        a = new Date(a);
        a.setHours(0, 0, 0);
        a.setDate(a.getDate() + 4 - (a.getDay() || 7));
        var b = new Date(a.getFullYear(), 0, 1);
        return Math.ceil(((a - b) / 864e5 + 1) / 7);
    };
    a.stringToDate = function(b, c) {
        var d = {}, e = [ {
            pattern: "YYYY",
            period: "year"
        }, {
            pattern: "YY",
            period: "year"
        }, {
            pattern: "MM",
            period: "month"
        }, {
            pattern: "M",
            period: "month"
        }, {
            pattern: "DD",
            period: "date"
        }, {
            pattern: "D",
            period: "date"
        }, {
            pattern: "JJ",
            period: "hours"
        }, {
            pattern: "J",
            period: "hours"
        }, {
            pattern: "HH",
            period: "hours"
        }, {
            pattern: "H",
            period: "hours"
        }, {
            pattern: "KK",
            period: "hours"
        }, {
            pattern: "K",
            period: "hours"
        }, {
            pattern: "LL",
            period: "hours"
        }, {
            pattern: "L",
            period: "hours"
        }, {
            pattern: "NN",
            period: "minutes"
        }, {
            pattern: "N",
            period: "minutes"
        }, {
            pattern: "SS",
            period: "seconds"
        }, {
            pattern: "S",
            period: "seconds"
        }, {
            pattern: "QQQ",
            period: "milliseconds"
        }, {
            pattern: "QQ",
            period: "milliseconds"
        }, {
            pattern: "Q",
            period: "milliseconds"
        } ], f = !0, g = c.indexOf("AA");
        -1 != g && (b.substr(g, 2), "pm" == b.toLowerCase && (f = !1));
        var g = c, h, i, j;
        for (j = 0; j < e.length; j++) i = e[j].period, d[i] = 0, "date" == i && (d[i] = 1);
        for (j = 0; j < e.length; j++) if (h = e[j].pattern, i = e[j].period, -1 != c.indexOf(h)) {
            var k = a.getFromDateString(h, b, g);
            c = c.replace(h, "");
            if ("KK" == h || "K" == h || "LL" == h || "L" == h) f || (k += 12);
            d[i] = k;
        }
        a.useUTC ? (e = new Date(), e.setUTCFullYear(d.year, d.month, d.date), e.setUTCHours(d.hours, d.minutes, d.seconds, d.milliseconds)) : e = new Date(d.year, d.month, d.date, d.hours, d.minutes, d.seconds, d.milliseconds);
        return e;
    };
    a.getFromDateString = function(a, b, c) {
        if (void 0 !== b) return c = c.indexOf(a), b = String(b), b = b.substr(c, a.length), 
        "0" == b.charAt(0) && (b = b.substr(1, b.length - 1)), b = Number(b), isNaN(b) && (b = 0), 
        -1 != a.indexOf("M") && b--, b;
    };
    a.formatDate = function(b, c, d) {
        d || (d = a);
        var e, f, g, h, i, j, k, l, m = a.getWeekNumber(b);
        a.useUTC ? (e = b.getUTCFullYear(), f = b.getUTCMonth(), g = b.getUTCDate(), h = b.getUTCDay(), 
        i = b.getUTCHours(), j = b.getUTCMinutes(), k = b.getUTCSeconds(), l = b.getUTCMilliseconds()) : (e = b.getFullYear(), 
        f = b.getMonth(), g = b.getDate(), h = b.getDay(), i = b.getHours(), j = b.getMinutes(), 
        k = b.getSeconds(), l = b.getMilliseconds());
        var n = String(e).substr(2, 2), o = "0" + h;
        c = c.replace(/W/g, m);
        m = i;
        24 == m && (m = 0);
        var p = m;
        10 > p && (p = "0" + p);
        c = c.replace(/JJ/g, p);
        c = c.replace(/J/g, m);
        p = i;
        0 === p && (p = 24, -1 != c.indexOf("H") && (g--, 0 === g && (e = new Date(b), e.setDate(e.getDate() - 1), 
        f = e.getMonth(), g = e.getDate(), e = e.getFullYear())));
        b = f + 1;
        9 > f && (b = "0" + b);
        m = g;
        10 > g && (m = "0" + g);
        var q = p;
        10 > q && (q = "0" + q);
        c = c.replace(/HH/g, q);
        c = c.replace(/H/g, p);
        p = i;
        11 < p && (p -= 12);
        q = p;
        10 > q && (q = "0" + q);
        c = c.replace(/KK/g, q);
        c = c.replace(/K/g, p);
        p = i;
        0 === p && (p = 12);
        12 < p && (p -= 12);
        q = p;
        10 > q && (q = "0" + q);
        c = c.replace(/LL/g, q);
        c = c.replace(/L/g, p);
        p = j;
        10 > p && (p = "0" + p);
        c = c.replace(/NN/g, p);
        c = c.replace(/N/g, j);
        j = k;
        10 > j && (j = "0" + j);
        c = c.replace(/SS/g, j);
        c = c.replace(/S/g, k);
        k = l;
        10 > k && (k = "00" + k);
        100 > k && (k = "0" + k);
        j = l;
        10 > j && (j = "00" + j);
        c = c.replace(/QQQ/g, k);
        c = c.replace(/QQ/g, j);
        c = c.replace(/Q/g, l);
        c = 12 > i ? c.replace(/A/g, d.amString) : c.replace(/A/g, d.pmString);
        c = c.replace(/YYYY/g, "@IIII@");
        c = c.replace(/YY/g, "@II@");
        c = c.replace(/MMMM/g, "@XXXX@");
        c = c.replace(/MMM/g, "@XXX@");
        c = c.replace(/MM/g, "@XX@");
        c = c.replace(/M/g, "@X@");
        c = c.replace(/DD/g, "@RR@");
        c = c.replace(/D/g, "@R@");
        c = c.replace(/EEEE/g, "@PPPP@");
        c = c.replace(/EEE/g, "@PPP@");
        c = c.replace(/EE/g, "@PP@");
        c = c.replace(/E/g, "@P@");
        c = c.replace(/@IIII@/g, e);
        c = c.replace(/@II@/g, n);
        c = c.replace(/@XXXX@/g, d.monthNames[f]);
        c = c.replace(/@XXX@/g, d.shortMonthNames[f]);
        c = c.replace(/@XX@/g, b);
        c = c.replace(/@X@/g, f + 1);
        c = c.replace(/@RR@/g, m);
        c = c.replace(/@R@/g, g);
        c = c.replace(/@PPPP@/g, d.dayNames[h]);
        c = c.replace(/@PPP@/g, d.shortDayNames[h]);
        c = c.replace(/@PP@/g, o);
        return c = c.replace(/@P@/g, h);
    };
    a.changeDate = function(b, c, d, e, f) {
        if (a.useUTC) return a.changeUTCDate(b, c, d, e, f);
        var g = -1;
        void 0 === e && (e = !0);
        void 0 === f && (f = !1);
        !0 === e && (g = 1);
        switch (c) {
          case "YYYY":
            b.setFullYear(b.getFullYear() + d * g);
            e || f || b.setDate(b.getDate() + 1);
            break;

          case "MM":
            c = b.getMonth();
            b.setMonth(b.getMonth() + d * g);
            b.getMonth() > c + d * g && b.setDate(b.getDate() - 1);
            e || f || b.setDate(b.getDate() + 1);
            break;

          case "DD":
            b.setDate(b.getDate() + d * g);
            break;

          case "WW":
            b.setDate(b.getDate() + d * g * 7);
            break;

          case "hh":
            b.setHours(b.getHours() + d * g);
            break;

          case "mm":
            b.setMinutes(b.getMinutes() + d * g);
            break;

          case "ss":
            b.setSeconds(b.getSeconds() + d * g);
            break;

          case "fff":
            b.setMilliseconds(b.getMilliseconds() + d * g);
        }
        return b;
    };
    a.changeUTCDate = function(a, b, c, d, e) {
        var f = -1;
        void 0 === d && (d = !0);
        void 0 === e && (e = !1);
        !0 === d && (f = 1);
        switch (b) {
          case "YYYY":
            a.setUTCFullYear(a.getUTCFullYear() + c * f);
            d || e || a.setUTCDate(a.getUTCDate() + 1);
            break;

          case "MM":
            b = a.getUTCMonth();
            a.setUTCMonth(a.getUTCMonth() + c * f);
            a.getUTCMonth() > b + c * f && a.setUTCDate(a.getUTCDate() - 1);
            d || e || a.setUTCDate(a.getUTCDate() + 1);
            break;

          case "DD":
            a.setUTCDate(a.getUTCDate() + c * f);
            break;

          case "WW":
            a.setUTCDate(a.getUTCDate() + c * f * 7);
            break;

          case "hh":
            a.setUTCHours(a.getUTCHours() + c * f);
            break;

          case "mm":
            a.setUTCMinutes(a.getUTCMinutes() + c * f);
            break;

          case "ss":
            a.setUTCSeconds(a.getUTCSeconds() + c * f);
            break;

          case "fff":
            a.setUTCMilliseconds(a.getUTCMilliseconds() + c * f);
        }
        return a;
    };
}();