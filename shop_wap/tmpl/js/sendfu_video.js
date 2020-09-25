(function (cjs, an) {

    var p; // shortcut to reference prototypes
    var lib={};var ss={};var img={};
    lib.ssMetadata = [];


// symbols:



    (lib.fd1 = function() {
        this.initialize(img.fd1);
    }).prototype = p = new cjs.Bitmap();
    p.nominalBounds = new cjs.Rectangle(0,0,550,576);


    (lib.fd2 = function() {
        this.initialize(img.fd2);
    }).prototype = p = new cjs.Bitmap();
    p.nominalBounds = new cjs.Rectangle(0,0,550,576);


    (lib.fd3 = function() {
        this.initialize(img.fd3);
    }).prototype = p = new cjs.Bitmap();
    p.nominalBounds = new cjs.Rectangle(0,0,550,576);


    (lib.fd4 = function() {
        this.initialize(img.fd4);
    }).prototype = p = new cjs.Bitmap();
    p.nominalBounds = new cjs.Rectangle(0,0,550,576);


    (lib.fd5 = function() {
        this.initialize(img.fd5);
    }).prototype = p = new cjs.Bitmap();
    p.nominalBounds = new cjs.Rectangle(0,0,550,576);


    (lib.fd6 = function() {
        this.initialize(img.fd6);
    }).prototype = p = new cjs.Bitmap();
    p.nominalBounds = new cjs.Rectangle(0,0,550,576);


    (lib.fd7 = function() {
        this.initialize(img.fd7);
    }).prototype = p = new cjs.Bitmap();
    p.nominalBounds = new cjs.Rectangle(0,0,550,576);


    (lib.fd8 = function() {
        this.initialize(img.fd8);
    }).prototype = p = new cjs.Bitmap();
    p.nominalBounds = new cjs.Rectangle(0,0,550,576);


    (lib.fd = function(mode,startPosition,loop) {
        this.initialize(mode,startPosition,loop,{});

        // 图层_1
        this.instance = new lib.fd1();
        this.instance.parent = this;
        this.instance.setTransform(-274,-288);

        this.instance_1 = new lib.fd2();
        this.instance_1.parent = this;
        this.instance_1.setTransform(-274,-288);

        this.instance_2 = new lib.fd3();
        this.instance_2.parent = this;
        this.instance_2.setTransform(-274,-288);

        this.instance_3 = new lib.fd4();
        this.instance_3.parent = this;
        this.instance_3.setTransform(-274,-288);

        this.instance_4 = new lib.fd5();
        this.instance_4.parent = this;
        this.instance_4.setTransform(-274,-288);

        this.instance_5 = new lib.fd6();
        this.instance_5.parent = this;
        this.instance_5.setTransform(-274,-288);

        this.instance_6 = new lib.fd7();
        this.instance_6.parent = this;
        this.instance_6.setTransform(-274,-288);

        this.instance_7 = new lib.fd8();
        this.instance_7.parent = this;
        this.instance_7.setTransform(-274,-288);

        this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.instance}]}).to({state:[{t:this.instance_1}]},1).to({state:[{t:this.instance_2}]},1).to({state:[{t:this.instance_3}]},1).to({state:[{t:this.instance_4}]},1).to({state:[{t:this.instance_5}]},1).to({state:[{t:this.instance_6}]},1).to({state:[{t:this.instance_7}]},1).wait(1));

    }).prototype = p = new cjs.MovieClip();
    p.nominalBounds = new cjs.Rectangle(-274,-288,550,576);


// stage content:
    (lib.FD = function(mode,startPosition,loop) {
        this.initialize(mode,startPosition,loop,{});

        // 图层_1
        this.fd = new lib.fd();
        this.fd.name = "fd";
        this.fd.parent = this;
        this.fd.setTransform(275,288,1,1,0,0,0,1,0);

        this.timeline.addTween(cjs.Tween.get(this.fd).wait(1));

    }).prototype = p = new cjs.MovieClip();
    p.nominalBounds = new cjs.Rectangle(275,288,550,576);
// library properties:
    lib.properties = {
        id: 'E424B4103EC0CC47B14200D6FC487DA0',
        width: 550,
        height: 576,
        fps: 24,
        color: "#FFFFFF",
        opacity: 0.00,
        manifest: [
            {src:"images/fd1.png?1533789806906", id:"fd1"},
            {src:"images/fd2.png?1533789806906", id:"fd2"},
            {src:"images/fd3.png?1533789806906", id:"fd3"},
            {src:"images/fd4.png?1533789806906", id:"fd4"},
            {src:"images/fd5.png?1533789806906", id:"fd5"},
            {src:"images/fd6.png?1533789806906", id:"fd6"},
            {src:"images/fd7.png?1533789806906", id:"fd7"},
            {src:"images/fd8.png?1533789806906", id:"fd8"}
        ],
        preloads: []
    };



// bootstrap callback support:

    (lib.Stage = function(canvas) {
        createjs.Stage.call(this, canvas);
    }).prototype = p = new createjs.Stage();

    p.setAutoPlay = function(autoPlay) {
        this.tickEnabled = autoPlay;
    }
    p.play = function() { this.tickEnabled = true; this.getChildAt(0).gotoAndPlay(this.getTimelinePosition()) }
    p.stop = function(ms) { if(ms) this.seek(ms); this.tickEnabled = false; }
    p.seek = function(ms) { this.tickEnabled = true; this.getChildAt(0).gotoAndStop(lib.properties.fps * ms / 1000); }
    p.getDuration = function() { return this.getChildAt(0).totalFrames / lib.properties.fps * 1000; }

    p.getTimelinePosition = function() { return this.getChildAt(0).currentFrame / lib.properties.fps * 1000; }

    an.bootcompsLoaded = an.bootcompsLoaded || [];
    if(!an.bootstrapListeners) {
        an.bootstrapListeners=[];
    }

    an.bootstrapCallback=function(fnCallback) {
        an.bootstrapListeners.push(fnCallback);
        if(an.bootcompsLoaded.length > 0) {
            for(var i=0; i<an.bootcompsLoaded.length; ++i) {
                fnCallback(an.bootcompsLoaded[i]);
            }
        }
    };

    an.compositions = an.compositions || {};
    an.compositions['E424B4103EC0CC47B14200D6FC487DA0'] = {
        getStage: function() { return exportRoot.getStage(); },
        getLibrary: function() { return lib; },
        getSpriteSheet: function() { return ss; },
        getImages: function() { return img; }
    };

    an.compositionLoaded = function(id) {
        an.bootcompsLoaded.push(id);
        for(var j=0; j<an.bootstrapListeners.length; j++) {
            an.bootstrapListeners[j](id);
        }
    }

    an.getComposition = function(id) {
        return an.compositions[id];
    }



})(createjs = createjs||{}, AdobeAn = AdobeAn||{});
var createjs, AdobeAn;