/*
 Copyright 2010 Google Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
 */
//var Base=function(){};Base.extend=function(b,e){var f=Base.prototype.extend;Base._prototyping=true;var d=new this;f.call(d,b);delete Base._prototyping;var c=d.constructor;var a=d.constructor=function(){if(!Base._prototyping){if(this._constructing||this.constructor==a){this._constructing=true;c.apply(this,arguments);delete this._constructing}else{if(arguments[0]!=null){return(arguments[0].extend||f).call(arguments[0],d)}}}};a.ancestor=this;a.extend=this.extend;a.forEach=this.forEach;a.implement=this.implement;a.prototype=d;a.toString=this.toString;a.valueOf=function(g){return(g=="object")?a:c.valueOf()};f.call(a,e);if(typeof a.init=="function"){a.init()}return a};Base.prototype={extend:function(b,h){if(arguments.length>1){var e=this[b];if(e&&(typeof h=="function")&&(!e.valueOf||e.valueOf()!=h.valueOf())&&/\bbase\b/.test(h)){var a=h.valueOf();h=function(){var l=this.base||Base.prototype.base;this.base=e;var i=a.apply(this,arguments);this.base=l;return i};h.valueOf=function(i){return(i=="object")?h:a};h.toString=Base.toString}this[b]=h}else{if(b){var g=Base.prototype.extend;if(!Base._prototyping&&typeof this!="function"){g=this.extend||g}var d={toSource:null};var f=["constructor","toString","valueOf"];var c=Base._prototyping?0:1;while(j=f[c++]){if(b[j]!=d[j]){g.call(this,j,b[j])}}for(var j in b){if(!d[j]){g.call(this,j,b[j])}}}}return this},base:function(){}};Base=Base.extend({constructor:function(){this.extend(arguments[0])}},{ancestor:Object,version:"1.1",forEach:function(a,d,c){for(var b in a){if(this.prototype[b]===undefined){d.call(c,a[b],b,a)}}},implement:function(){for(var a=0;a<arguments.length;a++){if(typeof arguments[a]=="function"){arguments[a](this.prototype)}else{this.prototype.extend(arguments[a])}}return this},toString:function(){return String(this.valueOf())}});(function(){var imagelib={};var Class={create:function(){var properties=arguments[0];function self(){this.initialize.apply(this,arguments)}for(var i in properties){self.prototype[i]=properties[i]}if(!self.prototype.initialize){self.prototype.initialize=function(){}}return self}};var ConvolutionFilter=Class.create({initialize:function(matrix,divisor,bias,separable){this.r=(Math.sqrt(matrix.length)-1)/2;this.matrix=matrix;this.divisor=divisor;this.bias=bias;this.separable=separable},apply:function(src,dst){var w=src.width,h=src.height;var srcData=src.data;var dstData=dst.data;var di,si,idx;var r,g,b;for(var y=0;y<h;++y){for(var x=0;x<w;++x){idx=r=g=b=0;di=(y*w+x)<<2;for(var ky=-this.r;ky<=this.r;++ky){for(var kx=-this.r;kx<=this.r;++kx){si=(Math.max(0,Math.min(h-1,y+ky))*w+Math.max(0,Math.min(w-1,x+kx)))<<2;r+=srcData[si]*this.matrix[idx];g+=srcData[si+1]*this.matrix[idx];b+=srcData[si+2]*this.matrix[idx];idx++}}dstData[di]=r/this.divisor+this.bias;dstData[di+1]=g/this.divisor+this.bias;dstData[di+2]=b/this.divisor+this.bias;dstData[di+3]=255}}}});var fx=function(){function n(b,c,d){return Math.max(b,Math.min(c,d))}function v(b){return{_:b,loadContentsOf:function(c){this._.loadContentsOf(c)},destroy:function(){this._.destroy()}}}function C(b){return v(r.fromElement(b))}function D(b,c){var d=a.getExtension("OES_texture_float")?a.FLOAT:a.UNSIGNED_BYTE;this._.texture&&this._.texture.destroy();this._.spareTexture&&this._.spareTexture.destroy();this.width=b;this.height=c;this._.texture=new r(b,c,a.RGBA,d);this._.spareTexture=new r(b,c,a.RGBA,d);this._.extraTexture=this._.extraTexture||new r(0,0,a.RGBA,d);this._.flippedShader=this._.flippedShader||new l(null,"uniform sampler2D texture;varying vec2 texCoord;void main(){gl_FragColor=texture2D(texture,vec2(texCoord.x,1.0-texCoord.y));}");this._.isInitialized=true}function E(b,c,d){if(!this._.isInitialized||b._.width!=this.width||b._.height!=this.height){D.call(this,c?c:b._.width,d?d:b._.height)}b._.use();this._.texture.drawTo(function(){l.getDefaultShader().drawRect()});return this}function F(){this._.texture.use();this._.flippedShader.drawRect();return this}function m(b,c,d,e){(d||this._.texture).use();this._.spareTexture.drawTo(function(){b.uniforms(c).drawRect()});this._.spareTexture.swapWith(e||this._.texture)}function G(b){b.parentNode.insertBefore(this,b);b.parentNode.removeChild(b);return this}function H(){var b=new r(this._.texture.width,this._.texture.height,a.RGBA,a.UNSIGNED_BYTE);this._.texture.use();b.drawTo(function(){l.getDefaultShader().drawRect()});return v(b)}function w(){var b=this._.texture.width,c=this._.texture.height,d=new Uint8Array(b*c*4);this._.texture.drawTo(function(){a.readPixels(0,0,b,c,a.RGBA,a.UNSIGNED_BYTE,d)});return d}function I(b){var c=this._.texture.width,d=this._.texture.height,e=w.call(this),f=document.createElement("canvas"),g=f.getContext("2d");f.width=c;f.height=d;c=g.createImageData(c,d);for(d=0;d<e.length;d++){c.data[d]=e[d]}g.putImageData(c,0,0);return f.toDataURL(b)}function k(b){return function(){a=this._.gl;return b.apply(this,arguments)}}function x(b,c,d,e,f,g,h,i){var j=d-f,o=e-g,p=h-f,y=i-g;f=b-d+f-h;g=c-e+g-i;var z=j*y-p*o;p=(f*y-p*g)/z;j=(j*g-f*o)/z;return[d-b+p*d,e-c+p*e,p,h-b+j*h,i-c+j*i,j,b,c,1]}function A(b){var c=b[0],d=b[1],e=b[2],f=b[3],g=b[4],h=b[5],i=b[6],j=b[7];b=b[8];var o=c*g*b-c*h*j-d*f*b+d*h*i+e*f*j-e*g*i;return[(g*b-h*j)/o,(e*j-d*b)/o,(d*h-e*g)/o,(h*i-f*b)/o,(c*b-e*i)/o,(e*f-c*h)/o,(f*j-g*i)/o,(d*i-c*j)/o,(c*g-d*f)/o]}function J(b,c){return[b[0]*c[0]+b[1]*c[3]+b[2]*c[6],b[0]*c[1]+b[1]*c[4]+b[2]*c[7],b[0]*c[2]+b[1]*c[5]+b[2]*c[8],b[3]*c[0]+b[4]*c[3]+b[5]*c[6],b[3]*c[1]+b[4]*c[4]+b[5]*c[7],b[3]*c[2]+b[4]*c[5]+b[5]*c[8],b[6]*c[0]+b[7]*c[3]+b[8]*c[6],b[6]*c[1]+b[7]*c[4]+b[8]*c[7],b[6]*c[2]+b[7]*c[5]+b[8]*c[8]]}function B(b){var c=b.length;this.xa=[];this.ya=[];this.u=[];this.y2=[];b.sort(function(g,h){return g[0]-h[0]});for(var d=0;d<c;d++){this.xa.push(b[d][0]);this.ya.push(b[d][1])}this.u[0]=0;this.y2[0]=0;for(d=1;d<c-1;++d){b=this.xa[d+1]-this.xa[d-1];var e=(this.xa[d]-this.xa[d-1])/b,f=e*this.y2[d-1]+2;this.y2[d]=(e-1)/f;this.u[d]=(6*((this.ya[d+1]-this.ya[d])/(this.xa[d+1]-this.xa[d])-(this.ya[d]-this.ya[d-1])/(this.xa[d]-this.xa[d-1]))/b-e*this.u[d-1])/f}this.y2[c-1]=0;for(d=c-2;d>=0;--d){this.y2[d]=this.y2[d]*this.y2[d+1]+this.u[d]}}function t(b,c){return new l(null,b+"uniform sampler2D texture;uniform vec2 texSize;varying vec2 texCoord;void main(){vec2 coord=texCoord*texSize;"+c+"gl_FragColor=texture2D(texture,coord/texSize);vec2 clampedCoord=clamp(coord,vec2(0.0),texSize);if(coord!=clampedCoord){gl_FragColor.a*=max(0.0,1.0-length(coord-clampedCoord));}}")}function K(b,c){a.brightnessContrast=a.brightnessContrast||new l(null,"uniform sampler2D texture;uniform float brightness;uniform float contrast;varying vec2 texCoord;void main(){vec4 color=texture2D(texture,texCoord);color.rgb+=brightness;if(contrast>0.0){color.rgb=(color.rgb-0.5)/(1.0-contrast)+0.5;}else{color.rgb=(color.rgb-0.5)*(1.0+contrast)+0.5;}gl_FragColor=color;}");m.call(this,a.brightnessContrast,{brightness:n(-1,b,1),contrast:n(-1,c,1)});return this}function s(b){b=new B(b);for(var c=[],d=0;d<256;d++){c.push(n(0,Math.floor(b.interpolate(d/255)*256),255))}return c}function L(b,c,d){b=s(b);if(arguments.length==1){c=d=b}else{c=s(c);d=s(d)}for(var e=[],f=0;f<256;f++){e.splice(e.length,0,b[f],c[f],d[f],255)}this._.extraTexture.initFromBytes(256,1,e);this._.extraTexture.use(1);a.curves=a.curves||new l(null,"uniform sampler2D texture;uniform sampler2D map;varying vec2 texCoord;void main(){vec4 color=texture2D(texture,texCoord);color.r=texture2D(map,vec2(color.r)).r;color.g=texture2D(map,vec2(color.g)).g;color.b=texture2D(map,vec2(color.b)).b;gl_FragColor=color;}");a.curves.textures({map:1});m.call(this,a.curves,{});return this}function M(b){a.denoise=a.denoise||new l(null,"uniform sampler2D texture;uniform float exponent;uniform float strength;uniform vec2 texSize;varying vec2 texCoord;void main(){vec4 center=texture2D(texture,texCoord);vec4 color=vec4(0.0);float total=0.0;for(float x=-4.0;x<=4.0;x+=1.0){for(float y=-4.0;y<=4.0;y+=1.0){vec4 sample=texture2D(texture,texCoord+vec2(x,y)/texSize);float weight=1.0-abs(dot(sample.rgb-center.rgb,vec3(0.25)));weight=pow(weight,exponent);color+=sample*weight;total+=weight;}}gl_FragColor=color/total;}");for(var c=0;c<2;c++){m.call(this,a.denoise,{exponent:Math.max(0,b),texSize:[this.width,this.height]})}return this}function N(b,c){a.hueSaturation=a.hueSaturation||new l(null,"uniform sampler2D texture;uniform float hue;uniform float saturation;varying vec2 texCoord;void main(){vec4 color=texture2D(texture,texCoord);float angle=hue*3.14159265;float s=sin(angle),c=cos(angle);vec3 weights=(vec3(2.0*c,-sqrt(3.0)*s-c,sqrt(3.0)*s-c)+1.0)/3.0;float len=length(color.rgb);color.rgb=vec3(dot(color.rgb,weights.xyz),dot(color.rgb,weights.zxy),dot(color.rgb,weights.yzx));float average=(color.r+color.g+color.b)/3.0;if(saturation>0.0){color.rgb+=(average-color.rgb)*(1.0-1.0/(1.001-saturation));}else{color.rgb+=(average-color.rgb)*(-saturation);}gl_FragColor=color;}");m.call(this,a.hueSaturation,{hue:n(-1,b,1),saturation:n(-1,c,1)});return this}function O(b){a.noise=a.noise||new l(null,"uniform sampler2D texture;uniform float amount;varying vec2 texCoord;float rand(vec2 co){return fract(sin(dot(co.xy,vec2(12.9898,78.233)))*43758.5453);}void main(){vec4 color=texture2D(texture,texCoord);float diff=(rand(texCoord)-0.5)*amount;color.r+=diff;color.g+=diff;color.b+=diff;gl_FragColor=color;}");m.call(this,a.noise,{amount:n(0,b,1)});return this}function P(b){a.sepia=a.sepia||new l(null,"uniform sampler2D texture;uniform float amount;varying vec2 texCoord;void main(){vec4 color=texture2D(texture,texCoord);float r=color.r;float g=color.g;float b=color.b;color.r=min(1.0,(r*(1.0-(0.607*amount)))+(g*(0.769*amount))+(b*(0.189*amount)));color.g=min(1.0,(r*0.349*amount)+(g*(1.0-(0.314*amount)))+(b*0.168*amount));color.b=min(1.0,(r*0.272*amount)+(g*0.534*amount)+(b*(1.0-(0.869*amount))));gl_FragColor=color;}");m.call(this,a.sepia,{amount:n(0,b,1)});return this}function Q(b,c){a.unsharpMask=a.unsharpMask||new l(null,"uniform sampler2D blurredTexture;uniform sampler2D originalTexture;uniform float strength;uniform float threshold;varying vec2 texCoord;void main(){vec4 blurred=texture2D(blurredTexture,texCoord);vec4 original=texture2D(originalTexture,texCoord);gl_FragColor=mix(blurred,original,1.0+strength);}");this._.extraTexture.ensureFormat(this._.texture);this._.texture.use();this._.extraTexture.drawTo(function(){l.getDefaultShader().drawRect()});this._.extraTexture.use(1);this.triangleBlur(b);a.unsharpMask.textures({originalTexture:1});m.call(this,a.unsharpMask,{strength:c});this._.extraTexture.unuse(1);return this}function R(b){a.vibrance=a.vibrance||new l(null,"uniform sampler2D texture;uniform float amount;varying vec2 texCoord;void main(){vec4 color=texture2D(texture,texCoord);float average=(color.r+color.g+color.b)/3.0;float mx=max(color.r,max(color.g,color.b));float amt=(mx-average)*(-amount*3.0);color.rgb=mix(color.rgb,vec3(mx),amt);gl_FragColor=color;}");m.call(this,a.vibrance,{amount:n(-1,b,1)});return this}function S(b,c){a.vignette=a.vignette||new l(null,"uniform sampler2D texture;uniform float size;uniform float amount;varying vec2 texCoord;void main(){vec4 color=texture2D(texture,texCoord);float dist=distance(texCoord,vec2(0.5,0.5));color.rgb*=smoothstep(0.8,size*0.799,dist*(amount+size));gl_FragColor=color;}");m.call(this,a.vignette,{size:n(0,b,1),amount:n(0,c,1)});return this}function T(b,c,d){a.lensBlurPrePass=a.lensBlurPrePass||new l(null,"uniform sampler2D texture;uniform float power;varying vec2 texCoord;void main(){vec4 color=texture2D(texture,texCoord);color=pow(color,vec4(power));gl_FragColor=vec4(color);}");var e="uniform sampler2D texture0;uniform sampler2D texture1;uniform vec2 delta0;uniform vec2 delta1;uniform float power;varying vec2 texCoord;"+q+"vec4 sample(vec2 delta){float offset=random(vec3(delta,151.7182),0.0);vec4 color=vec4(0.0);float total=0.0;for(float t=0.0;t<=30.0;t++){float percent=(t+offset)/30.0;color+=texture2D(texture0,texCoord+delta*percent);total+=1.0;}return color/total;}";a.lensBlur0=a.lensBlur0||new l(null,e+"void main(){gl_FragColor=sample(delta0);}");a.lensBlur1=a.lensBlur1||new l(null,e+"void main(){gl_FragColor=(sample(delta0)+sample(delta1))*0.5;}");a.lensBlur2=a.lensBlur2||(new l(null,e+"void main(){vec4 color=(sample(delta0)+2.0*texture2D(texture1,texCoord))/3.0;gl_FragColor=pow(color,vec4(power));}")).textures({texture1:1});e=[];for(var f=0;f<3;f++){var g=d+f*Math.PI*2/3;e.push([b*Math.sin(g)/this.width,b*Math.cos(g)/this.height])}b=Math.pow(10,n(-1,c,1));m.call(this,a.lensBlurPrePass,{power:b});this._.extraTexture.ensureFormat(this._.texture);m.call(this,a.lensBlur0,{delta0:e[0]},this._.texture,this._.extraTexture);m.call(this,a.lensBlur1,{delta0:e[1],delta1:e[2]},this._.extraTexture,this._.extraTexture);m.call(this,a.lensBlur0,{delta0:e[1]});this._.extraTexture.use(1);m.call(this,a.lensBlur2,{power:1/b,delta0:e[2]});return this}function U(b,c,d,e,f,g){a.tiltShift=a.tiltShift||new l(null,"uniform sampler2D texture;uniform float blurRadius;uniform float gradientRadius;uniform vec2 start;uniform vec2 end;uniform vec2 delta;uniform vec2 texSize;varying vec2 texCoord;"+q+"void main(){vec4 color=vec4(0.0);float total=0.0;float offset=random(vec3(12.9898,78.233,151.7182),0.0);vec2 normal=normalize(vec2(start.y-end.y,end.x-start.x));float radius=smoothstep(0.0,1.0,abs(dot(texCoord*texSize-start,normal))/gradientRadius)*blurRadius;for(float t=-30.0;t<=30.0;t++){float percent=(t+offset-0.5)/30.0;float weight=1.0-abs(percent);color+=texture2D(texture,texCoord+delta/texSize*percent*radius)*weight;total+=weight;}gl_FragColor=color/total;}");var h=d-b,i=e-c,j=Math.sqrt(h*h+i*i);m.call(this,a.tiltShift,{blurRadius:f,gradientRadius:g,start:[b,c],end:[d,e],delta:[h/j,i/j],texSize:[this.width,this.height]});m.call(this,a.tiltShift,{blurRadius:f,gradientRadius:g,start:[b,c],end:[d,e],delta:[-i/j,h/j],texSize:[this.width,this.height]});return this}function V(b){a.triangleBlur=a.triangleBlur||new l(null,"uniform sampler2D texture;uniform vec2 delta;varying vec2 texCoord;"+q+"void main(){vec4 color=vec4(0.0);float total=0.0;float offset=random(vec3(12.9898,78.233,151.7182),0.0);for(float t=-30.0;t<=30.0;t++){float percent=(t+offset-0.5)/30.0;float weight=1.0-abs(percent);color+=texture2D(texture,texCoord+delta*percent)*weight;total+=weight;}gl_FragColor=color/total;}");m.call(this,a.triangleBlur,{delta:[b/this.width,0]});m.call(this,a.triangleBlur,{delta:[0,b/this.height]});return this}function W(b,c,d){a.zoomBlur=a.zoomBlur||new l(null,"uniform sampler2D texture;uniform vec2 center;uniform float strength;uniform vec2 texSize;varying vec2 texCoord;"+q+"void main(){vec4 color=vec4(0.0);float total=0.0;vec2 toCenter=center-texCoord*texSize;float offset=random(vec3(12.9898,78.233,151.7182),0.0);for(float t=0.0;t<=40.0;t++){float percent=(t+offset)/40.0;float weight=4.0*(percent-percent*percent);color+=texture2D(texture,texCoord+toCenter*percent*strength/texSize)*weight;total+=weight;}gl_FragColor=color/total;}");m.call(this,a.zoomBlur,{center:[b,c],strength:d,texSize:[this.width,this.height]});return this}function X(b,c,d,e){a.colorHalftone=a.colorHalftone||new l(null,"uniform sampler2D texture;uniform vec2 center;uniform float angle;uniform float scale;uniform vec2 texSize;varying vec2 texCoord;float pattern(float angle){float s=sin(angle),c=cos(angle);vec2 tex=texCoord*texSize-center;vec2 point=vec2(c*tex.x-s*tex.y,s*tex.x+c*tex.y)*scale;return(sin(point.x)*sin(point.y))*4.0;}void main(){vec4 color=texture2D(texture,texCoord);vec3 cmy=1.0-color.rgb;float k=min(cmy.x,min(cmy.y,cmy.z));cmy=(cmy-k)/(1.0-k);cmy=clamp(cmy*10.0-3.0+vec3(pattern(angle+0.26179),pattern(angle+1.30899),pattern(angle)),0.0,1.0);k=clamp(k*10.0-5.0+pattern(angle+0.78539),0.0,1.0);gl_FragColor=vec4(1.0-cmy-k,color.a);}");m.call(this,a.colorHalftone,{center:[b,c],angle:d,scale:Math.PI/e,texSize:[this.width,this.height]});return this}function Y(b,c,d,e){a.dotScreen=a.dotScreen||new l(null,"uniform sampler2D texture;uniform vec2 center;uniform float angle;uniform float scale;uniform vec2 texSize;varying vec2 texCoord;float pattern(){float s=sin(angle),c=cos(angle);vec2 tex=texCoord*texSize-center;vec2 point=vec2(c*tex.x-s*tex.y,s*tex.x+c*tex.y)*scale;return(sin(point.x)*sin(point.y))*4.0;}void main(){vec4 color=texture2D(texture,texCoord);float average=(color.r+color.g+color.b)/3.0;gl_FragColor=vec4(vec3(average*10.0-5.0+pattern()),color.a);}");m.call(this,a.dotScreen,{center:[b,c],angle:d,scale:Math.PI/e,texSize:[this.width,this.height]});return this}function Z(b){a.edgeWork1=a.edgeWork1||new l(null,"uniform sampler2D texture;uniform vec2 delta;varying vec2 texCoord;"+q+"void main(){vec2 color=vec2(0.0);vec2 total=vec2(0.0);float offset=random(vec3(12.9898,78.233,151.7182),0.0);for(float t=-30.0;t<=30.0;t++){float percent=(t+offset-0.5)/30.0;float weight=1.0-abs(percent);vec3 sample=texture2D(texture,texCoord+delta*percent).rgb;float average=(sample.r+sample.g+sample.b)/3.0;color.x+=average*weight;total.x+=weight;if(abs(t)<15.0){weight=weight*2.0-1.0;color.y+=average*weight;total.y+=weight;}}gl_FragColor=vec4(color/total,0.0,1.0);}");a.edgeWork2=a.edgeWork2||new l(null,"uniform sampler2D texture;uniform vec2 delta;varying vec2 texCoord;"+q+"void main(){vec2 color=vec2(0.0);vec2 total=vec2(0.0);float offset=random(vec3(12.9898,78.233,151.7182),0.0);for(float t=-30.0;t<=30.0;t++){float percent=(t+offset-0.5)/30.0;float weight=1.0-abs(percent);vec2 sample=texture2D(texture,texCoord+delta*percent).xy;color.x+=sample.x*weight;total.x+=weight;if(abs(t)<15.0){weight=weight*2.0-1.0;color.y+=sample.y*weight;total.y+=weight;}}float c=clamp(10000.0*(color.y/total.y-color.x/total.x)+0.5,0.0,1.0);gl_FragColor=vec4(c,c,c,1.0);}");m.call(this,a.edgeWork1,{delta:[b/this.width,0]});m.call(this,a.edgeWork2,{delta:[0,b/this.height]});return this}function $(b,c,d){a.hexagonalPixelate=a.hexagonalPixelate||new l(null,"uniform sampler2D texture;uniform vec2 center;uniform float scale;uniform vec2 texSize;varying vec2 texCoord;void main(){vec2 tex=(texCoord*texSize-center)/scale;tex.y/=0.866025404;tex.x-=tex.y*0.5;vec2 a;if(tex.x+tex.y-floor(tex.x)-floor(tex.y)<1.0)a=vec2(floor(tex.x),floor(tex.y));else a=vec2(ceil(tex.x),ceil(tex.y));vec2 b=vec2(ceil(tex.x),floor(tex.y));vec2 c=vec2(floor(tex.x),ceil(tex.y));vec3 TEX=vec3(tex.x,tex.y,1.0-tex.x-tex.y);vec3 A=vec3(a.x,a.y,1.0-a.x-a.y);vec3 B=vec3(b.x,b.y,1.0-b.x-b.y);vec3 C=vec3(c.x,c.y,1.0-c.x-c.y);float alen=length(TEX-A);float blen=length(TEX-B);float clen=length(TEX-C);vec2 choice;if(alen<blen){if(alen<clen)choice=a;else choice=c;}else{if(blen<clen)choice=b;else choice=c;}choice.x+=choice.y*0.5;choice.y*=0.866025404;choice*=scale/texSize;gl_FragColor=texture2D(texture,choice+center/texSize);}");m.call(this,a.hexagonalPixelate,{center:[b,c],scale:d,texSize:[this.width,this.height]});return this}function aa(b){a.ink=a.ink||new l(null,"uniform sampler2D texture;uniform float strength;uniform vec2 texSize;varying vec2 texCoord;void main(){vec2 dx=vec2(1.0/texSize.x,0.0);vec2 dy=vec2(0.0,1.0/texSize.y);vec4 color=texture2D(texture,texCoord);float bigTotal=0.0;float smallTotal=0.0;vec3 bigAverage=vec3(0.0);vec3 smallAverage=vec3(0.0);for(float x=-2.0;x<=2.0;x+=1.0){for(float y=-2.0;y<=2.0;y+=1.0){vec3 sample=texture2D(texture,texCoord+dx*x+dy*y).rgb;bigAverage+=sample;bigTotal+=1.0;if(abs(x)+abs(y)<2.0){smallAverage+=sample;smallTotal+=1.0;}}}vec3 edge=max(vec3(0.0),bigAverage/bigTotal-smallAverage/smallTotal);gl_FragColor=vec4(color.rgb-dot(edge,edge)*strength*100000.0,color.a);}");m.call(this,a.ink,{strength:b*b*b*b*b,texSize:[this.width,this.height]});return this}function ba(b,c,d,e){a.bulgePinch=a.bulgePinch||t("uniform float radius;uniform float strength;uniform vec2 center;","coord-=center;float distance=length(coord);if(distance<radius){float percent=distance/radius;if(strength>0.0){coord*=mix(1.0,smoothstep(0.0,radius/distance,percent),strength*0.75);}else{coord*=mix(1.0,pow(percent,1.0+strength*0.75)*radius/distance,1.0-percent);}}coord+=center;");m.call(this,a.bulgePinch,{radius:d,strength:n(-1,e,1),center:[b,c],texSize:[this.width,this.height]});return this}function ca(b,c,d){a.matrixWarp=a.matrixWarp||t("uniform mat3 matrix;uniform bool useTextureSpace;","if(useTextureSpace)coord=coord/texSize*2.0-1.0;vec3 warp=matrix*vec3(coord,1.0);coord=warp.xy/warp.z;if(useTextureSpace)coord=(coord*0.5+0.5)*texSize;");b=Array.prototype.concat.apply([],b);if(b.length==4){b=[b[0],b[1],0,b[2],b[3],0,0,0,1]}else{if(b.length!=9){throw"can only warp with 2x2 or 3x3 matrix"}}m.call(this,a.matrixWarp,{matrix:c?A(b):b,texSize:[this.width,this.height],useTextureSpace:d|0});return this}function da(b,c){var d=x.apply(null,c),e=x.apply(null,b);return this.matrixWarp(J(A(d),e))}function ea(b,c,d,e){a.swirl=a.swirl||t("uniform float radius;uniform float angle;uniform vec2 center;","coord-=center;float distance=length(coord);if(distance<radius){float percent=(radius-distance)/radius;float theta=percent*percent*angle;float s=sin(theta);float c=cos(theta);coord=vec2(coord.x*c-coord.y*s,coord.x*s+coord.y*c);}coord+=center;");m.call(this,a.swirl,{radius:d,center:[b,c],angle:e,texSize:[this.width,this.height]});return this}var u={},a;u.canvas=function(){var b=document.createElement("canvas");try{a=b.getContext("experimental-webgl",{premultipliedAlpha:false})}catch(c){a=null}if(!a){throw"This browser does not support WebGL"}b._={gl:a,isInitialized:false,texture:null,spareTexture:null,flippedShader:null};b.texture=k(C);b.draw=k(E);b.update=k(F);b.replace=k(G);b.contents=k(H);b.getPixelArray=k(w);b.toDataURL=k(I);b.brightnessContrast=k(K);b.hexagonalPixelate=k($);b.hueSaturation=k(N);b.colorHalftone=k(X);b.triangleBlur=k(V);b.unsharpMask=k(Q);b.perspective=k(da);b.matrixWarp=k(ca);b.bulgePinch=k(ba);b.tiltShift=k(U);b.dotScreen=k(Y);b.edgeWork=k(Z);b.lensBlur=k(T);b.zoomBlur=k(W);b.noise=k(O);b.denoise=k(M);b.curves=k(L);b.swirl=k(ea);b.ink=k(aa);b.vignette=k(S);b.vibrance=k(R);b.sepia=k(P);return b};u.splineInterpolate=s;var l=function(){function b(f,g){var h=a.createShader(f);a.shaderSource(h,g);a.compileShader(h);if(!a.getShaderParameter(h,a.COMPILE_STATUS)){throw"compile error: "+a.getShaderInfoLog(h)}return h}function c(f,g){this.texCoordAttribute=this.vertexAttribute=null;this.program=a.createProgram();f=f||d;g=g||e;g="precision highp float;"+g;a.attachShader(this.program,b(a.VERTEX_SHADER,f));a.attachShader(this.program,b(a.FRAGMENT_SHADER,g));a.linkProgram(this.program);if(!a.getProgramParameter(this.program,a.LINK_STATUS)){throw"link error: "+a.getProgramInfoLog(this.program)}}var d="attribute vec2 vertex;attribute vec2 _texCoord;varying vec2 texCoord;void main(){texCoord=_texCoord;gl_Position=vec4(vertex*2.0-1.0,0.0,1.0);}",e="uniform sampler2D texture;varying vec2 texCoord;void main(){gl_FragColor=texture2D(texture,texCoord);}";c.prototype.destroy=function(){a.deleteProgram(this.program);this.program=null};c.prototype.uniforms=function(f){a.useProgram(this.program);for(var g in f){if(f.hasOwnProperty(g)){var h=a.getUniformLocation(this.program,g);if(h!==null){var i=f[g];if(Object.prototype.toString.call(i)=="[object Array]"){switch(i.length){case 1:a.uniform1fv(h,new Float32Array(i));break;case 2:a.uniform2fv(h,new Float32Array(i));break;case 3:a.uniform3fv(h,new Float32Array(i));break;case 4:a.uniform4fv(h,new Float32Array(i));break;case 9:a.uniformMatrix3fv(h,false,new Float32Array(i));break;case 16:a.uniformMatrix4fv(h,false,new Float32Array(i));break;default:throw"dont't know how to load uniform \""+g+'" of length '+i.length}}else{if(Object.prototype.toString.call(i)=="[object Number]"){a.uniform1f(h,i)}else{throw'attempted to set uniform "'+g+'" to invalid value '+(i||"undefined").toString()}}}}}return this};c.prototype.textures=function(f){a.useProgram(this.program);for(var g in f){f.hasOwnProperty(g)&&a.uniform1i(a.getUniformLocation(this.program,g),f[g])}return this};c.prototype.drawRect=function(f,g,h,i){var j=a.getParameter(a.VIEWPORT);g=g!==void 0?(g-j[1])/j[3]:0;f=f!==void 0?(f-j[0])/j[2]:0;h=h!==void 0?(h-j[0])/j[2]:1;i=i!==void 0?(i-j[1])/j[3]:1;if(a.vertexBuffer==null){a.vertexBuffer=a.createBuffer()}a.bindBuffer(a.ARRAY_BUFFER,a.vertexBuffer);a.bufferData(a.ARRAY_BUFFER,new Float32Array([f,g,f,i,h,g,h,i]),a.STATIC_DRAW);if(a.texCoordBuffer==null){a.texCoordBuffer=a.createBuffer();a.bindBuffer(a.ARRAY_BUFFER,a.texCoordBuffer);a.bufferData(a.ARRAY_BUFFER,new Float32Array([0,0,0,1,1,0,1,1]),a.STATIC_DRAW)}if(this.vertexAttribute==null){this.vertexAttribute=a.getAttribLocation(this.program,"vertex");a.enableVertexAttribArray(this.vertexAttribute)}if(this.texCoordAttribute==null){this.texCoordAttribute=a.getAttribLocation(this.program,"_texCoord");a.enableVertexAttribArray(this.texCoordAttribute)}a.useProgram(this.program);a.bindBuffer(a.ARRAY_BUFFER,a.vertexBuffer);a.vertexAttribPointer(this.vertexAttribute,2,a.FLOAT,false,0,0);a.bindBuffer(a.ARRAY_BUFFER,a.texCoordBuffer);a.vertexAttribPointer(this.texCoordAttribute,2,a.FLOAT,false,0,0);a.drawArrays(a.TRIANGLE_STRIP,0,4)};c.getDefaultShader=function(){a.defaultShader=a.defaultShader||new c;return a.defaultShader};return c}();B.prototype.interpolate=function(b){for(var c=0,d=this.ya.length-1;d-c>1;){var e=d+c>>1;if(this.xa[e]>b){d=e}else{c=e}}e=this.xa[d]-this.xa[c];var f=(this.xa[d]-b)/e;b=(b-this.xa[c])/e;return f*this.ya[c]+b*this.ya[d]+((f*f*f-f)*this.y2[c]+(b*b*b-b)*this.y2[d])*e*e/6};var r=function(){function b(e,f,g,h){this.id=a.createTexture();this.width=e;this.height=f;this.format=g;this.type=h;a.bindTexture(a.TEXTURE_2D,this.id);a.texParameteri(a.TEXTURE_2D,a.TEXTURE_MAG_FILTER,a.LINEAR);a.texParameteri(a.TEXTURE_2D,a.TEXTURE_MIN_FILTER,a.LINEAR);a.texParameteri(a.TEXTURE_2D,a.TEXTURE_WRAP_S,a.CLAMP_TO_EDGE);a.texParameteri(a.TEXTURE_2D,a.TEXTURE_WRAP_T,a.CLAMP_TO_EDGE);e&&f&&a.texImage2D(a.TEXTURE_2D,0,this.format,e,f,0,this.format,this.type,null)}function c(e){if(d==null){d=document.createElement("canvas")}d.width=e.width;d.height=e.height;e=d.getContext("2d");e.clearRect(0,0,d.width,d.height);return e}b.fromElement=function(e){var f=new b(0,0,a.RGBA,a.UNSIGNED_BYTE);f.loadContentsOf(e);return f};b.prototype.loadContentsOf=function(e){this.width=e.width||e.videoWidth;this.height=e.height||e.videoHeight;a.bindTexture(a.TEXTURE_2D,this.id);a.texImage2D(a.TEXTURE_2D,0,this.format,this.format,this.type,e)};b.prototype.initFromBytes=function(e,f,g){this.width=e;this.height=f;this.format=a.RGBA;this.type=a.UNSIGNED_BYTE;a.bindTexture(a.TEXTURE_2D,this.id);a.texImage2D(a.TEXTURE_2D,0,a.RGBA,e,f,0,a.RGBA,this.type,new Uint8Array(g))};b.prototype.destroy=function(){a.deleteTexture(this.id);this.id=null};b.prototype.use=function(e){a.activeTexture(a.TEXTURE0+(e||0));a.bindTexture(a.TEXTURE_2D,this.id)};b.prototype.unuse=function(e){a.activeTexture(a.TEXTURE0+(e||0));a.bindTexture(a.TEXTURE_2D,null)};b.prototype.ensureFormat=function(e,f,g,h){if(arguments.length==1){var i=arguments[0];e=i.width;f=i.height;g=i.format;h=i.type}if(e!=this.width||f!=this.height||g!=this.format||h!=this.type){this.width=e;this.height=f;this.format=g;this.type=h;a.bindTexture(a.TEXTURE_2D,this.id);a.texImage2D(a.TEXTURE_2D,0,this.format,e,f,0,this.format,this.type,null)}};b.prototype.drawTo=function(e){a.framebuffer=a.framebuffer||a.createFramebuffer();a.bindFramebuffer(a.FRAMEBUFFER,a.framebuffer);a.framebufferTexture2D(a.FRAMEBUFFER,a.COLOR_ATTACHMENT0,a.TEXTURE_2D,this.id,0);a.viewport(0,0,this.width,this.height);e();a.bindFramebuffer(a.FRAMEBUFFER,null)};var d=null;b.prototype.fillUsingCanvas=function(e){e(c(this));this.format=a.RGBA;this.type=a.UNSIGNED_BYTE;a.bindTexture(a.TEXTURE_2D,this.id);a.texImage2D(a.TEXTURE_2D,0,a.RGBA,a.RGBA,a.UNSIGNED_BYTE,d);return this};b.prototype.toImage=function(e){this.use();l.getDefaultShader().drawRect();var f=this.width*this.height*4,g=new Uint8Array(f),h=c(this),i=h.createImageData(this.width,this.height);a.readPixels(0,0,this.width,this.height,a.RGBA,a.UNSIGNED_BYTE,g);for(var j=0;j<f;j++){i.data[j]=g[j]}h.putImageData(i,0,0);e.src=d.toDataURL()};b.prototype.swapWith=function(e){var f;f=e.id;e.id=this.id;this.id=f;f=e.width;e.width=this.width;this.width=f;f=e.height;e.height=this.height;this.height=f;f=e.format;e.format=this.format;this.format=f};return b}(),q="float random(vec3 scale,float seed){return fract(sin(dot(gl_FragCoord.xyz+seed,scale))*43758.5453+seed);}";return u}();imagelib.drawing={};imagelib.drawing.context=function(size){var canvas=document.createElement("canvas");canvas.width=size.w;canvas.height=size.h;canvas.style.setProperty("image-rendering","optimizeQuality",null);return canvas.getContext("2d")};imagelib.drawing.copy=function(dstCtx,src,size){dstCtx.drawImage(src.canvas||src,0,0,size.w,size.h)};imagelib.drawing.clear=function(ctx,size){ctx.clearRect(0,0,size.w,size.h)};imagelib.drawing.drawCenterInside=function(dstCtx,src,dstRect,srcRect){if(srcRect.w/srcRect.h>dstRect.w/dstRect.h){var h=srcRect.h*dstRect.w/srcRect.w;imagelib.drawing.drawImageScaled(dstCtx,src,srcRect.x,srcRect.y,srcRect.w,srcRect.h,dstRect.x,dstRect.y+(dstRect.h-h)/2,dstRect.w,h)}else{var w=srcRect.w*dstRect.h/srcRect.h;imagelib.drawing.drawImageScaled(dstCtx,src,srcRect.x,srcRect.y,srcRect.w,srcRect.h,dstRect.x+(dstRect.w-w)/2,dstRect.y,w,dstRect.h)}};imagelib.drawing.drawCenterCrop=function(dstCtx,src,dstRect,srcRect){if(srcRect.w/srcRect.h>dstRect.w/dstRect.h){var w=srcRect.h*dstRect.w/dstRect.h;imagelib.drawing.drawImageScaled(dstCtx,src,srcRect.x+(srcRect.w-w)/2,srcRect.y,w,srcRect.h,dstRect.x,dstRect.y,dstRect.w,dstRect.h)}else{var h=srcRect.w*dstRect.h/dstRect.w;imagelib.drawing.drawImageScaled(dstCtx,src,srcRect.x,srcRect.y+(srcRect.h-h)/2,srcRect.w,h,dstRect.x,dstRect.y,dstRect.w,dstRect.h)}};imagelib.drawing.drawImageScaled=function(dstCtx,src,sx,sy,sw,sh,dx,dy,dw,dh){if((dw<sw&&dh<sh)&&imagelib.ALLOW_MANUAL_RESCALE){sx=Math.floor(sx);sy=Math.floor(sy);sw=Math.ceil(sw);sh=Math.ceil(sh);dx=Math.floor(dx);dy=Math.floor(dy);dw=Math.ceil(dw);dh=Math.ceil(dh);var tmpCtx=imagelib.drawing.context({w:sw,h:sh});tmpCtx.drawImage(src.canvas||src,-sx,-sy);var srcData=tmpCtx.getImageData(0,0,sw,sh);var outCtx=imagelib.drawing.context({w:dw,h:dh});var outData=outCtx.createImageData(dw,dh);var tr,tg,tb,ta;var numOpaquePixels;var numPixels;for(var y=0;y<dh;y++){for(var x=0;x<dw;x++){tr=tg=tb=ta=0;numOpaquePixels=numPixels=0;for(var j=Math.floor(y*sh/dh);j<(y+1)*sh/dh;j++){for(var i=Math.floor(x*sw/dw);i<(x+1)*sw/dw;i++){++numPixels;ta+=srcData.data[(j*sw+i)*4+3];if(srcData.data[(j*sw+i)*4+3]==0){continue}++numOpaquePixels;tr+=srcData.data[(j*sw+i)*4+0];tg+=srcData.data[(j*sw+i)*4+1];tb+=srcData.data[(j*sw+i)*4+2]}}outData.data[(y*dw+x)*4+0]=tr/numOpaquePixels;outData.data[(y*dw+x)*4+1]=tg/numOpaquePixels;outData.data[(y*dw+x)*4+2]=tb/numOpaquePixels;outData.data[(y*dw+x)*4+3]=ta/numPixels}}outCtx.putImageData(outData,0,0);dstCtx.drawImage(outCtx.canvas,dx,dy)}else{dstCtx.drawImage(src.canvas||src,sx,sy,sw,sh,dx,dy,dw,dh)}};imagelib.drawing.trimRectWorkerJS_=["self['onmessage'] = function(event) {                                       ","  var l = event.data.size.w, t = event.data.size.h, r = 0, b = 0;           ","                                                                            ","  var alpha;                                                                ","  for (var y = 0; y < event.data.size.h; y++) {                             ","    for (var x = 0; x < event.data.size.w; x++) {                           ","      alpha = event.data.imageData.data[                                    ","          ((y * event.data.size.w + x) << 2) + 3];                          ","      if (alpha >= event.data.minAlpha) {                                   ","        l = Math.min(x, l);                                                 ","        t = Math.min(y, t);                                                 ","        r = Math.max(x, r);                                                 ","        b = Math.max(y, b);                                                 ","      }                                                                     ","    }                                                                       ","  }                                                                         ","                                                                            ","  if (l > r) {                                                              ","    // no pixels, couldn't trim                                             ","    postMessage({ x: 0, y: 0, w: event.data.size.w, h: event.data.size.h });","    return;                                                                 ","  }                                                                         ","                                                                            ","  postMessage({ x: l, y: t, w: r - l + 1, h: b - t + 1 });                  ","};                                                                          ",""].join("\n");imagelib.drawing.getTrimRect=function(ctx,size,minAlpha,callback){callback=callback||function(){};if(!ctx.canvas){var src=ctx;ctx=imagelib.drawing.context(size);imagelib.drawing.copy(ctx,src,size)}if(minAlpha==0){callback({x:0,y:0,w:size.w,h:size.h})}minAlpha=minAlpha||1;var worker=imagelib.util.runWorkerJs(imagelib.drawing.trimRectWorkerJS_,{imageData:ctx.getImageData(0,0,size.w,size.h),size:size,minAlpha:minAlpha},callback);return worker};imagelib.drawing.getCenterOfMass=function(ctx,size,minAlpha,callback){callback=callback||function(){};if(!ctx.canvas){var src=ctx;ctx=imagelib.drawing.context(size);imagelib.drawing.copy(ctx,src,size)}if(minAlpha==0){callback({x:size.w/2,y:size.h/2})}minAlpha=minAlpha||1;var l=size.w,t=size.h,r=0,b=0;var imageData=ctx.getImageData(0,0,size.w,size.h);var sumX=0;var sumY=0;var n=0;var alpha;for(var y=0;y<size.h;y++){for(var x=0;x<size.w;x++){alpha=imageData.data[((y*size.w+x)<<2)+3];if(alpha>=minAlpha){sumX+=x;sumY+=y;++n}}}if(n<=0){callback({x:size.w/2,h:size.h/2})}callback({x:Math.round(sumX/n),y:Math.round(sumY/n)})};imagelib.drawing.copyAsAlpha=function(dstCtx,src,size,onColor,offColor){onColor=onColor||"#fff";offColor=offColor||"#000";dstCtx.save();dstCtx.clearRect(0,0,size.w,size.h);dstCtx.globalCompositeOperation="source-over";imagelib.drawing.copy(dstCtx,src,size);dstCtx.globalCompositeOperation="source-atop";dstCtx.fillStyle=onColor;dstCtx.fillRect(0,0,size.w,size.h);dstCtx.globalCompositeOperation="destination-atop";dstCtx.fillStyle=offColor;dstCtx.fillRect(0,0,size.w,size.h);dstCtx.restore()};imagelib.drawing.makeAlphaMask=function(ctx,size,fillColor){var src=ctx.getImageData(0,0,size.w,size.h);var dst=ctx.createImageData(size.w,size.h);var srcData=src.data;var dstData=dst.data;var i,g;for(var y=0;y<size.h;y++){for(var x=0;x<size.w;x++){i=(y*size.w+x)<<2;g=0.3*srcData[i]+0.59*srcData[i+1]+0.11*srcData[i+2];dstData[i]=dstData[i+1]=dstData[i+2]=255;dstData[i+3]=g}}ctx.putImageData(dst,0,0);if(fillColor){ctx.save();ctx.globalCompositeOperation="source-atop";ctx.fillStyle=fillColor;ctx.fillRect(0,0,size.w,size.h);ctx.restore()}};imagelib.drawing.applyFilter=function(filter,ctx,size){var src=ctx.getImageData(0,0,size.w,size.h);var dst=ctx.createImageData(size.w,size.h);filter.apply(src,dst);ctx.putImageData(dst,0,0)};(function(){function slowblur_(radius,ctx,size){var rows=Math.ceil(radius);var r=rows*2+1;var matrix=new Array(r*r);var sigma=radius/3;var sigma22=2*sigma*sigma;var sqrtPiSigma22=Math.sqrt(Math.PI*sigma22);var radius2=radius*radius;var total=0;var index=0;var distance2;for(var y=-rows;y<=rows;y++){for(var x=-rows;x<=rows;x++){distance2=1*x*x+1*y*y;if(distance2>radius2){matrix[index]=0}else{matrix[index]=Math.exp(-distance2/sigma22)/sqrtPiSigma22}total+=matrix[index];index++}}imagelib.drawing.applyFilter(new ConvolutionFilter(matrix,total,0,true),ctx,size)}function glfxblur_(radius,ctx,size){var canvas=fx.canvas();var texture=canvas.texture(ctx.canvas);canvas.draw(texture).triangleBlur(radius).update();ctx.clearRect(0,0,canvas.width,canvas.height);ctx.drawImage(canvas,0,0)}imagelib.drawing.blur=function(radius,ctx,size){try{if(size.w>128||size.h>128){glfxblur_(radius,ctx,size)}else{slowblur_(radius,ctx,size)}}catch(e){slowblur_(radius,ctx,size)}}})();imagelib.drawing.fx=function(effects,dstCtx,src,size){effects=effects||[];var outerEffects=[];var innerEffects=[];var fillEffects=[];for(var i=0;i<effects.length;i++){if(/^outer/.test(effects[i].effect)){outerEffects.push(effects[i])}else{if(/^inner/.test(effects[i].effect)){innerEffects.push(effects[i])}else{if(/^fill/.test(effects[i].effect)){fillEffects.push(effects[i])}}}}var padLeft=0,padTop,padRight,padBottom;var paddedSize;var tmpCtx,tmpCtx2;for(var i=0;i<outerEffects.length;i++){padLeft=Math.max(padLeft,outerEffects[i].blur||0)}padTop=padRight=padBottom=padLeft;paddedSize={w:size.w+padLeft+padRight,h:size.h+padTop+padBottom};tmpCtx=imagelib.drawing.context(paddedSize);for(var i=0;i<outerEffects.length;i++){var effect=outerEffects[i];dstCtx.save();tmpCtx.save();switch(effect.effect){case"outer-shadow":imagelib.drawing.clear(tmpCtx,paddedSize);tmpCtx.save();tmpCtx.translate(padLeft,padTop);imagelib.drawing.copyAsAlpha(tmpCtx,src.canvas||src,size);tmpCtx.restore();if(effect.blur){imagelib.drawing.blur(effect.blur,tmpCtx,paddedSize)}imagelib.drawing.makeAlphaMask(tmpCtx,paddedSize,effect.color||"#000");if(effect.translate){dstCtx.translate(effect.translate.x||0,effect.translate.y||0)}dstCtx.globalAlpha=Math.max(0,Math.min(1,effect.opacity||1));dstCtx.translate(-padLeft,-padTop);imagelib.drawing.copy(dstCtx,tmpCtx,paddedSize);break}dstCtx.restore();tmpCtx.restore()}dstCtx.save();tmpCtx=imagelib.drawing.context(size);imagelib.drawing.clear(tmpCtx,size);imagelib.drawing.copy(tmpCtx,src.canvas||src,size);var fillOpacity=1;if(fillEffects.length){var effect=fillEffects[0];tmpCtx.save();tmpCtx.globalCompositeOperation="source-atop";switch(effect.effect){case"fill-color":tmpCtx.fillStyle=effect.color;break;case"fill-lineargradient":var gradient=tmpCtx.createLinearGradient(effect.from.x,effect.from.y,effect.to.x,effect.to.y);for(var i=0;i<effect.colors.length;i++){gradient.addColorStop(effect.colors[i].offset,effect.colors[i].color)}tmpCtx.fillStyle=gradient;break}fillOpacity=Math.max(0,Math.min(1,effect.opacity||1));tmpCtx.fillRect(0,0,size.w,size.h);tmpCtx.restore()}dstCtx.globalAlpha=fillOpacity;imagelib.drawing.copy(dstCtx,tmpCtx,size);dstCtx.globalAlpha=1;var translate;padLeft=padTop=padRight=padBottom=0;for(var i=0;i<innerEffects.length;i++){translate=effect.translate||{};padLeft=Math.max(padLeft,(innerEffects[i].blur||0)+Math.max(0,translate.x||0));padTop=Math.max(padTop,(innerEffects[i].blur||0)+Math.max(0,translate.y||0));padRight=Math.max(padRight,(innerEffects[i].blur||0)+Math.max(0,-translate.x||0));padBottom=Math.max(padBottom,(innerEffects[i].blur||0)+Math.max(0,-translate.y||0))}paddedSize={w:size.w+padLeft+padRight,h:size.h+padTop+padBottom};tmpCtx=imagelib.drawing.context(paddedSize);tmpCtx2=imagelib.drawing.context(paddedSize);for(var i=0;i<innerEffects.length;i++){var effect=innerEffects[i];dstCtx.save();tmpCtx.save();switch(effect.effect){case"inner-shadow":imagelib.drawing.clear(tmpCtx,paddedSize);tmpCtx.save();tmpCtx.translate(padLeft,padTop);imagelib.drawing.copyAsAlpha(tmpCtx,src.canvas||src,size,"#fff","#000");tmpCtx.restore();tmpCtx2.save();tmpCtx2.translate(padLeft,padTop);imagelib.drawing.copyAsAlpha(tmpCtx2,src.canvas||src,size);tmpCtx2.restore();if(effect.blur){imagelib.drawing.blur(effect.blur,tmpCtx2,paddedSize)}imagelib.drawing.makeAlphaMask(tmpCtx2,paddedSize,"#000");if(effect.translate){tmpCtx.translate(effect.translate.x||0,effect.translate.y||0)}tmpCtx.globalCompositeOperation="source-over";imagelib.drawing.copy(tmpCtx,tmpCtx2,paddedSize);imagelib.drawing.makeAlphaMask(tmpCtx,paddedSize,effect.color);dstCtx.globalAlpha=Math.max(0,Math.min(1,effect.opacity||1));dstCtx.translate(-padLeft,-padTop);imagelib.drawing.copy(dstCtx,tmpCtx,paddedSize);break}tmpCtx.restore();dstCtx.restore()}dstCtx.restore()};imagelib.loadImageResources=function(images,callback){var imageResources={};var checkForCompletion=function(){for(var id in images){if(!(id in imageResources)){return}}(callback||function(){})(imageResources);callback=null};for(var id in images){var img=document.createElement("img");img.src=images[id];(function(img,id){img.onload=function(){imageResources[id]=img;checkForCompletion()};img.onerror=function(){imageResources[id]=null;checkForCompletion()}})(img,id)}};imagelib.loadFromUri=function(uri,callback){callback=callback||function(){};var img=document.createElement("img");img.src=uri;img.onload=function(){callback(img)};img.onerror=function(){callback(null)}};imagelib.toDataUri=function(img){var canvas=document.createElement("canvas");canvas.width=img.naturalWidth;canvas.height=img.naturalHeight;var ctx=canvas.getContext("2d");ctx.drawImage(img,0,0);return canvas.toDataURL()};imagelib.util={};imagelib.util.runWorkerJs=function(js,params,callback){var BlobBuilder=(window.BlobBuilder||window.WebKitBlobBuilder);var URL=(window.URL||window.webkitURL);var Worker=window.Worker;if(URL&&BlobBuilder&&Worker){var bb=new BlobBuilder();bb.append(js);var worker=new Worker(URL.createObjectURL(bb.getBlob()));worker.onmessage=function(event){callback(event.data)};worker.postMessage(params);return worker}else{(function(){var __DUMMY_OBJECT__={};var postMessage=function(result){callback(result)};eval("var self=__DUMMY_OBJECT__;\n"+js);__DUMMY_OBJECT__.onmessage({data:params})})();return{terminate:function(){}}}};window.imagelib=imagelib})();(function(){var b={};b.checkBrowser=function(){var c=navigator.userAgent.match(/Chrome\/(\d+)/);var e=false;if(c){var d=parseInt(c[1],10);if(d>=6){e=true}}if(!e){$("<div>").addClass("browser-unsupported-note ui-state-highlight").attr("title","Your browser is not supported.").append($('<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;">')).append($("<p>").html('Currently only <a href="http://www.google.com/chrome">Google Chrome</a> is recommended and supported. Your mileage may vary with other browsers.')).prependTo("body")}};b.forms={};b.forms.Form=Base.extend({constructor:function(e,d){this.id_=e;this.params_=d;this.fields_=d.fields;this.pauseNotify_=false;for(var c=0;c<this.fields_.length;c++){this.fields_[c].setForm_(this)}this.onChange=this.params_.onChange||function(){}},createUI:function(c){for(var d=0;d<this.fields_.length;d++){var e=this.fields_[d];e.createUI(c)}},notifyChanged_:function(c){if(this.pauseNotify_){return}this.onChange(c)},getValues:function(){var c={};for(var d=0;d<this.fields_.length;d++){var e=this.fields_[d];c[e.id_]=e.getValue()}return c},getValuesSerialized:function(){var c={};for(var d=0;d<this.fields_.length;d++){var f=this.fields_[d];var e=f.serializeValue?f.serializeValue():undefined;if(e!==undefined){c[f.id_]=f.serializeValue()}}return c},setValuesSerialized:function(d){this.pauseNotify_=true;for(var c=0;c<this.fields_.length;c++){var e=this.fields_[c];if(e.id_ in d&&e.deserializeValue){e.deserializeValue(d[e.id_])}}this.pauseNotify_=false;this.notifyChanged_(null)}});b.forms.Field=Base.extend({constructor:function(d,c){this.id_=d;this.params_=c},setForm_:function(c){this.form_=c},getLongId:function(){return this.form_.id_+"-"+this.id_},getHtmlId:function(){return"_frm-"+this.getLongId()},createUI:function(c){c=$(c);return $("<div>").addClass("form-field-outer").append($("<label>").attr("for",this.getHtmlId()).text(this.params_.title).append($("<div>").addClass("form-field-help-text").css("display",this.params_.helpText?"":"none").html(this.params_.helpText))).append($("<div>").addClass("form-field-container")).appendTo(c)}});b.forms.Separator = b.forms.Field.extend({createUI: function(c) {var fc = $('.form-field-container', this.base(c));var me = this;this.el_ = $('<div class="form-field-separator">&nbsp;</div>').appendTo(fc)},getValue: function() {return '1';},setValue: function(val, pauseUi) {},serializeValue: function() {return '1';},deserializeValue: function(s) {}});b.forms.TextField=b.forms.Field.extend({createUI:function(c){var e=$(".form-field-container",this.base(c));var d=this;this.el_=$("<input>").attr("type","text").addClass("form-text").val(this.getValue()).bind("change",function(){d.setValue($(this).val(),true)}).bind("keydown change",function(){var g=this;var f=d.getValue();window.setTimeout(function(){var h=$(g).val();if(f!=h){d.setValue(h,true)}},0)}).appendTo(e)},getValue:function(){var c=this.value_;if(typeof c!="string"){c=this.params_.defaultValue||""}return c},setValue:function(d,c){this.value_=d;if(!c){$(this.el_).val(d)}this.form_.notifyChanged_(this)},serializeValue:function(){return this.getValue()},deserializeValue:function(c){this.setValue(c)}});b.forms.AutocompleteTextField=b.forms.Field.extend({createUI:function(c){var g=$(".form-field-container",this.base(c));var f=this;var e=this.getHtmlId()+"-datalist";this.el_=$("<input>").attr("type","text").addClass("form-text").attr("list",e).val(this.getValue()).bind("keydown change",function(){var h=this;window.setTimeout(function(){f.setValue($(h).val(),true)},0)}).appendTo(g);this.datalistEl_=$("<datalist>").attr("id",e).appendTo(g);this.params_.items=this.params_.items||[];for(var d=0;d<this.params_.items.length;d++){this.datalistEl_.append($("<option>").attr("value",this.params_.items[d]))}},getValue:function(){var c=this.value_;if(typeof c!="string"){c=this.params_.defaultValue||""}return c},setValue:function(d,c){this.value_=d;if(!c){$(this.el_).val(d)}this.form_.notifyChanged_(this)},serializeValue:function(){return this.getValue()},deserializeValue:function(c){this.setValue(c)}});b.forms.ColorField=b.forms.Field.extend({createUI:function(c){var e=$(".form-field-container",this.base(c));var d=this;this.el_=$("<input>").addClass("form-color").attr("type","text").attr("id",this.getHtmlId()).css("background-color",this.getValue().color).appendTo(e);this.el_.spectrum({color:this.getValue().color,showInput:true,showPalette:true,palette:[["#fff","#000"],["#33b5e5","#09c"],["#a6c","#93c"],["#9c0","#690"],["#fb3","#f80"],["#f44","#c00"]],localStorageKey:"recentcolors",showInitial:true,showButtons:false,change:function(f){d.setValue({color:f.toHexString()},true)}});if(this.params_.alpha){this.alphaEl_=$("<input>").attr("type","range").attr("min",0).attr("max",100).val(this.getValue().alpha).addClass("form-range").change(function(){d.setValue({alpha:Number(d.alphaEl_.val())},true)}).appendTo(e)}},getValue:function(){var c=this.value_||this.params_.defaultValue||"#000000";if(/^([0-9a-f]{6}|[0-9a-f]{3})$/i.test(c)){c="#"+c}var d=this.alpha_;if(typeof d!="number"){d=this.params_.defaultAlpha;if(typeof d!="number"){d=100}}return{color:c,alpha:d}},setValue:function(e,d){e=e||{};if("color" in e){this.value_=e.color}if("alpha" in e){this.alpha_=e.alpha}var c=this.getValue();this.el_.css("background-color",c.color);if(!d){$(this.el_).spectrum("set",c.color);if(this.alphaEl_){this.alphaEl_.val(c.alpha)}}this.form_.notifyChanged_(this)},serializeValue:function(){var c=this.getValue();return c.color.replace(/^#/,"")+","+c.alpha},deserializeValue:function(d){var e={};var c=d.split(",",2);if(c.length>=1){e.color=c[0]}if(c.length>=2){e.alpha=parseInt(c[1],10)}this.setValue(e)}});b.forms.EnumField=b.forms.Field.extend({createUI:function(c){var g=$(".form-field-container",this.base(c));var f=this;if(this.params_.buttons){this.el_=$("<div>").attr("id",this.getHtmlId()).addClass("form-field-buttonset").appendTo(g);for(var d=0;d<this.params_.options.length;d++){var e=this.params_.options[d];$("<input>").attr({type:"radio",name:this.getHtmlId(),id:this.getHtmlId()+"-"+e.id,value:e.id}).change(function(){f.setValueInternal_($(this).val(),true)}).appendTo(this.el_);$("<label>").attr("for",this.getHtmlId()+"-"+e.id).html(e.title).appendTo(this.el_)}this.setValueInternal_(this.getValue())}else{this.el_=$("<select>").attr("id",this.getHtmlId()).change(function(){f.setValueInternal_($(this).val(),true)}).appendTo(g);for(var d=0;d<this.params_.options.length;d++){var e=this.params_.options[d];$("<option>").attr("value",e.id).text(e.title).appendTo(this.el_)}this.el_.combobox({selected:function(h,i){f.setValueInternal_(i.item.value,true);f.form_.notifyChanged_(f)}});this.setValueInternal_(this.getValue())}},getValue:function(){var c=this.value_;if(c===undefined){c=this.params_.defaultValue||this.params_.options[0].id}return c},setValue:function(d,c){this.setValueInternal_(d,c)},setValueInternal_:function(d,c){this.value_=d;if(!c){if(this.params_.buttons){$("input",this.el_).each(function(e,f){$(f).attr("checked",$(f).val()==d)})}else{this.el_.val(d)}}this.form_.notifyChanged_(this)},serializeValue:function(){return this.getValue()},deserializeValue:function(c){this.setValue(c)}});b.forms.BooleanField=b.forms.EnumField.extend({constructor:function(d,c){c.options=[{id:"1",title:c.onText||"Yes"},{id:"0",title:c.offText||"No"}];c.defaultValue=c.defaultValue?"1":"0";c.buttons=true;this.base(d,c)},getValue:function(){return this.base()=="1"},setValue:function(d,c){this.base(d?"1":"0",c)},serializeValue:function(){return this.getValue()?"1":"0"},deserializeValue:function(c){this.setValue(c=="1")}});b.forms.RangeField=b.forms.Field.extend({createUI:function(c){var e=$(".form-field-container",this.base(c));var d=this;this.el_=$("<input>").attr("type","range").attr("min",this.params_.min||0).attr("max",this.params_.max||100).attr("step",this.params_.step||1).addClass("form-range").change(function(){d.setValue(Number(d.el_.val())||0,true)}).val(this.getValue()).appendTo(e);if(this.params_.textFn||this.params_.showText){this.params_.textFn=this.params_.textFn||function(f){return f};this.textEl_=$("<div>").addClass("form-range-text").text(this.params_.textFn(this.getValue())).appendTo(e)}},getValue:function(){var c=this.value_;if(typeof c!="number"){c=this.params_.defaultValue;if(typeof c!="number"){c=0}}return c},setValue:function(d,c){this.value_=d;if(!c){this.el_.val(d)}if(this.textEl_){this.textEl_.text(this.params_.textFn(d))}this.form_.notifyChanged_(this)},serializeValue:function(){return this.getValue()},deserializeValue:function(c){this.setValue(Number(c))}});b.hash={};b.hash.boundFormOldOnChange_=null;b.hash.boundForm_=null;b.hash.currentParams_={};b.hash.currentHash_=null;b.hash.bindFormToDocumentHash=function(d){if(!b.hash.boundForm_){var e=function(){var f=b.hash.paramsToHash(b.hash.hashToParams((document.location.href.match(/#.*/)||[""])[0]));if(f!=b.hash.currentHash_){var g=f;var h=b.hash.hashToParams(g);b.hash.onHashParamsChanged_(h);b.hash.currentParams_=h;b.hash.currentHash_=g}window.setTimeout(e,100)};window.setTimeout(e,0)}if(b.hash.boundFormOldOnChange_&&b.hash.boundForm_){b.hash.boundForm_.onChange=b.hash.boundFormOldOnChange_}b.hash.boundFormOldOnChange_=d.onChange;b.hash.boundForm_=d;var c=null;b.hash.boundForm_.onChange=function(){if(c){window.clearTimeout(c)}c=window.setTimeout(function(){b.hash.onFormChanged_()},500);(b.hash.boundFormOldOnChange_||function(){}).apply(d,arguments)}};b.hash.onHashParamsChanged_=function(c){if(b.hash.boundForm_){b.hash.boundForm_.setValuesSerialized(c)}};b.hash.onFormChanged_=function(){if(b.hash.boundForm_){b.hash.currentParams_=b.hash.boundForm_.getValuesSerialized();b.hash.currentHash_=b.hash.paramsToHash(b.hash.currentParams_);document.location.hash=b.hash.currentHash_}};b.hash.hashToParams=function(l){var e={};l=l.replace(/^[?#]/,"");var c=l.split("&");for(var m=0;m<c.length;m++){var g=c[m].split("=",2);var p=g[0]?decodeURIComponent(g[0]):g[0];var d=g[1]?decodeURIComponent(g[1]):g[1];var n=p.split(".");var h=e;for(var f=0;f<n.length-1;f++){h[n[f]]=h[n[f]]||{};h=h[n[f]]}var o=n[n.length-1];if(o in h){if(h[o]&&h[o].splice){h[o].push(d)}else{h[o]=[h[o],d]}}else{h[o]=d}}return e};b.hash.paramsToHash=function(l,f){var c=[];var h=function(i){return encodeURIComponent((f?f+".":"")+i)};var g=function(m,i){if(i===false){i=0}if(i===true){i=1}c.push(h(m)+"="+encodeURIComponent(i.toString()))};for(var e in l){var j=l[e];if(j===undefined||j===null){continue}if(typeof j=="object"){if(j.splice&&j.length){for(var d=0;d<j.length;d++){g(e,j[d])}}else{c.push(b.hash.paramsToHash(j,h(e)))}}else{g(e,j)}}return c.join("&")};var a=window.canvg&&true;b.forms.ImageField=b.forms.Field.extend({constructor:function(d,c){this.valueType_=null;this.textParams_={};this.imageParams_={};this.spaceFormValues_={};this.base(d,c)},createUI:function(d){var j=this.base(d);var h=$(".form-field-container",j);var m=this;j.addClass("form-field-drop-target");j.get(0).ondragenter=b.forms.ImageField.makeDragenterHandler_(j);j.get(0).ondragleave=b.forms.ImageField.makeDragleaveHandler_(j);j.get(0).ondragover=b.forms.ImageField.makeDragoverHandler_(j);j.get(0).ondrop=b.forms.ImageField.makeDropHandler_(j,function(i){i.stopPropagation();i.preventDefault();b.forms.ImageField.loadImageFromFileList(i.dataTransfer.files,function(q){if(!q){return}m.setValueType_("image");m.imageParams_=q;m.valueFilename_=q.name;m.renderValueAndNotifyChanged_()})});this.el_=$("<div>").attr("id",this.getHtmlId()).addClass("form-field-buttonset").appendTo(h);var l;if(this.params_.imageOnly){l=["image","Select Image"]}else{l=["image","Image","clipart","Clipart","text","Text"]}var e={};for(var g=0;g<l.length/2;g++){$("<input>").attr({type:"radio",name:this.getHtmlId(),id:this.getHtmlId()+"-"+l[g*2],value:l[g*2]}).appendTo(this.el_);e[l[g*2]]=$("<label>").attr("for",this.getHtmlId()+"-"+l[g*2]).text(l[g*2+1]).appendTo(this.el_)}this.fileEl_=$("<input>").addClass("form-image-hidden-file-field").attr({id:this.getHtmlId(),type:"file",accept:"image/*"}).change(function(){b.forms.ImageField.loadImageFromFileList(m.fileEl_.get(0).files,function(i){if(!i){return}m.setValueType_("image");m.imageParams_=i;m.valueFilename_=i.name;m.renderValueAndNotifyChanged_()})}).appendTo(this.el_);e.image.click(function(i){m.fileEl_.trigger("click");m.setValueType_(null);m.renderValueAndNotifyChanged_();i.preventDefault();return false});if(!this.params_.imageOnly){var c=$("<div>").addClass("form-image-type-params form-image-type-params-clipart").hide().appendTo(h);var p=$("<div>").addClass("form-image-clipart-list").appendTo(c);for(var g=0;g<b.forms.ImageField.clipartList_.length;g++){var n="res/clipart/"+b.forms.ImageField.clipartList_[g];$("<img>").addClass("form-image-clipart-item").attr("src",n).attr("title",b.forms.ImageField.clipartList_[g]).click(function(i){return function(){m.loadClipart_(i)}}(n)).appendTo(p)}var o=$("<div>").addClass("form-image-clipart-attribution").html(["For clipart sources, visit ",'<a href="http://developer.android.com/design/downloads/">',"Android Design: Downloads","</a>."].join("")).appendTo(c);e.clipart.click(function(i){m.setValueType_("clipart");if(b.AUTO_TRIM){m.spaceFormTrimField_.setValue(false)}m.renderValueAndNotifyChanged_()});var f=$("<div>").addClass("form-subform form-image-type-params form-image-type-params-text").hide().appendTo(h);this.textForm_=new b.forms.Form(this.form_.id_+"-"+this.id_+"-textform",{onChange:function(){var i=m.textForm_.getValues();m.textParams_.text=i.text;m.textParams_.fontStack=i.font?i.font:"Roboto, sans-serif";m.valueFilename_=i.text;m.tryLoadWebFont_();m.renderValueAndNotifyChanged_()},fields:[new b.forms.TextField("text",{title:"Text",}),new b.forms.AutocompleteTextField("font",{title:"Font",items:b.forms.ImageField.fontList_})]});this.textForm_.createUI(f);e.text.click(function(i){m.setValueType_("text");if(b.AUTO_TRIM){m.spaceFormTrimField_.setValue(true)}m.renderValueAndNotifyChanged_()})}if(!this.params_.noTrimForm){this.spaceFormValues_={};this.spaceForm_=new b.forms.Form(this.form_.id_+"-"+this.id_+"-spaceform",{onChange:function(){m.spaceFormValues_=m.spaceForm_.getValues();m.renderValueAndNotifyChanged_()},fields:[(this.spaceFormTrimField_=new b.forms.BooleanField("trim",{title:"Trim",defaultValue:this.params_.defaultValueTrim||false,offText:"Don't Trim",onText:"Trim"})),new b.forms.RangeField("pad",{title:"Padding",defaultValue:0,min:-0.1,max:0.5,step:0.05,textFn:function(i){return(i*100).toFixed(0)+"%"}}),]});this.spaceForm_.createUI($("<div>").addClass("form-subform").appendTo(h));this.spaceFormValues_=this.spaceForm_.getValues()}else{this.spaceFormValues_={}}if(!this.params_.noPreview){this.imagePreview_=$("<canvas>").addClass("form-image-preview").hide().appendTo(h.parent())}},tryLoadWebFont_:function(e){var g=this.textForm_.getValues()["font"];if(this.loadedWebFont_==g||!g){return}var d=this;if(!e){if(this.tryLoadWebFont_.timeout_){clearTimeout(this.tryLoadWebFont_.timeout_)}this.tryLoadWebFont_.timeout_=setTimeout(function(){d.tryLoadWebFont_(true)},100);return}this.loadedWebFont_=g;var c=this.form_.id_+"-"+this.id_+"-__webfont-stylesheet__";var f=$("#"+c);if(!f.length){f=$("<link>").attr("id",c).attr("rel","stylesheet").appendTo("head")}f.attr("href","http://fonts.googleapis.com/css?family="+encodeURIComponent(g))},setValueType_:function(c){this.valueType_=c;$("input",this.el_).removeAttr("checked");$(".form-image-type-params",this.el_.parent()).hide();if(c){$("#"+this.getHtmlId()+"-"+c).attr("checked",true);$(".form-image-type-params-"+c,this.el_.parent()).show()}},loadClipart_:function(c){var d=a&&c.match(/\.svg$/);$("img.form-image-clipart-item",this.el_.parent()).removeClass("selected");$('img[src="'+c+'"]').addClass("selected");this.imageParams_={canvgSvgUri:d?c:null,uri:d?null:c};this.clipartSrc_=c;this.valueFilename_=c.match(/[^/]+$/)[0];this.renderValueAndNotifyChanged_()},clearValue:function(){this.valueType_=null;this.valueFilename_=null;this.valueCtx_=null;this.fileEl_.val("");if(this.imagePreview_){this.imagePreview_.hide()}},getValue:function(){return{ctx:this.valueCtx_,type:this.valueType_,name:this.valueFilename_}},renderValueAndNotifyChanged_:function(){if(!this.valueType_){this.valueCtx_=null}var g=this;switch(this.valueType_){case"image":case"clipart":if(this.imageParams_.canvgSvgText||this.imageParams_.canvgSvgUri){var e=document.createElement("canvas");var f={w:800,h:800};e.className="offscreen";e.width=f.w;e.height=f.h;document.body.appendChild(e);canvg(e,this.imageParams_.canvgSvgText||this.imageParams_.canvgSvgUri,{scaleWidth:f.w,scaleHeight:f.h,ignoreMouse:true,ignoreAnimation:true,ignoreDimensions:true,ignoreClear:true});d(e.getContext("2d"),f);document.body.removeChild(e)}else{if(this.imageParams_.uri){imagelib.loadFromUri(this.imageParams_.uri,function(m){var n={w:m.naturalWidth,h:m.naturalHeight};var l=imagelib.drawing.context(n);imagelib.drawing.copy(l,m,n);d(l,n)})}}break;case"text":var f={w:4800,h:1600};var i=f.h*0.75;var c=imagelib.drawing.context(f);var h=this.textParams_.text||"";h=" "+h+" ";c.fillStyle="#000";c.font="bold "+i+"px/"+f.h+"px "+this.textParams_.fontStack;c.textBaseline="alphabetic";c.fillText(h,0,i);f.w=Math.ceil(Math.min(c.measureText(h).width,f.w)||f.w);d(c,f);break;default:g.form_.notifyChanged_(g)}function d(m,l){if(g.spaceFormValues_.trim){if(g.trimWorker_){g.trimWorker_.terminate()}g.trimWorker_=imagelib.drawing.getTrimRect(m,l,1,function(n){j(m,l,n)})}else{j(m,l,{x:0,y:0,w:l.w,h:l.h})}}function j(p,n,o){var s=g.spaceFormValues_.trim?0.001:0;if(o.x==0&&o.y==0&&o.w==n.w&&o.h==n.h){s=0}var r=Math.round(((g.spaceFormValues_.pad||0)+s)*Math.min(o.w,o.h));var q={x:r,y:r,w:o.w,h:o.h};var m=imagelib.drawing.context({w:o.w+r*2,h:o.h+r*2});imagelib.drawing.drawCenterInside(m,p,q,o);g.valueCtx_=m;if(g.imagePreview_){g.imagePreview_.attr("width",m.canvas.width);g.imagePreview_.attr("height",m.canvas.height);var l=g.imagePreview_.get(0).getContext("2d");l.drawImage(m.canvas,0,0);g.imagePreview_.show()}g.form_.notifyChanged_(g)}},serializeValue:function(){return{type:this.valueType_,space:this.spaceForm_.getValuesSerialized(),clipart:(this.valueType_=="clipart")?this.clipartSrc_:null,text:(this.valueType_=="text")?this.textForm_.getValuesSerialized():null}},deserializeValue:function(c){if(c.type){this.setValueType_(c.type)}if(c.space){this.spaceForm_.setValuesSerialized(c.space);this.spaceFormValues_=this.spaceForm_.getValues()}if(c.clipart&&this.valueType_=="clipart"){this.loadClipart_(c.clipart)}if(c.text&&this.valueType_=="text"){this.textForm_.setValuesSerialized(c.text);this.tryLoadWebFont_()}}});b.forms.ImageField.clipartList_=["icons/action_about.svg","icons/action_help.svg","icons/action_search.svg","icons/action_settings.svg","icons/alerts_and_states_add_alarm.svg","icons/alerts_and_states_airplane_mode_off.svg","icons/alerts_and_states_airplane_mode_on.svg","icons/alerts_and_states_error.svg","icons/alerts_and_states_warning.svg","icons/av_add_to_queue.svg","icons/av_download.svg","icons/av_fast_forward.svg","icons/av_full_screen.svg","icons/av_make_available_offline.svg","icons/av_next.svg","icons/av_pause.svg","icons/av_pause_over_video.svg","icons/av_play.svg","icons/av_play_over_video.svg","icons/av_previous.svg","icons/av_repeat.svg","icons/av_replay.svg","icons/av_return_from_full_screen.svg","icons/av_rewind.svg","icons/av_shuffle.svg","icons/av_stop.svg","icons/av_upload.svg","icons/collections_cloud.svg","icons/collections_collection.svg","icons/collections_go_to_today.svg","icons/collections_labels.svg","icons/collections_new_label.svg","icons/collections_sort_by_size.svg","icons/collections_view_as_grid.svg","icons/collections_view_as_list.svg","icons/content_attachment.svg","icons/content_backspace.svg","icons/content_copy.svg","icons/content_cut.svg","icons/content_discard.svg","icons/content_edit.svg","icons/content_email.svg","icons/content_event.svg","icons/content_import_export.svg","icons/content_merge.svg","icons/content_new.svg","icons/content_new_attachment.svg","icons/content_new_email.svg","icons/content_new_event.svg","icons/content_new_picture.svg","icons/content_paste.svg","icons/content_picture.svg","icons/content_read.svg","icons/content_remove.svg","icons/content_save.svg","icons/content_select_all.svg","icons/content_split.svg","icons/content_undo.svg","icons/content_unread.svg","icons/device_access_accounts.svg","icons/device_access_alarms.svg","icons/device_access_battery.svg","icons/device_access_bluetooth.svg","icons/device_access_bluetooth_connected.svg","icons/device_access_bluetooth_searching.svg","icons/device_access_brightness_auto.svg","icons/device_access_brightness_high.svg","icons/device_access_brightness_low.svg","icons/device_access_brightness_medium.svg","icons/device_access_call.svg","icons/device_access_camera.svg","icons/device_access_data_usage.svg","icons/device_access_dial_pad.svg","icons/device_access_end_call.svg","icons/device_access_flash_automatic.svg","icons/device_access_flash_off.svg","icons/device_access_flash_on.svg","icons/device_access_location_found.svg","icons/device_access_location_off.svg","icons/device_access_location_searching.svg","icons/device_access_mic.svg","icons/device_access_mic_muted.svg","icons/device_access_network_cell.svg","icons/device_access_network_wifi.svg","icons/device_access_new_account.svg","icons/device_access_not_secure.svg","icons/device_access_ring_volume.svg","icons/device_access_screen_locked_to_landscape.svg","icons/device_access_screen_locked_to_portrait.svg","icons/device_access_screen_rotation.svg","icons/device_access_sd_storage.svg","icons/device_access_secure.svg","icons/device_access_storage_1.svg","icons/device_access_switch_camera.svg","icons/device_access_switch_video.svg","icons/device_access_time.svg","icons/device_access_usb.svg","icons/device_access_video.svg","icons/device_access_volume_muted.svg","icons/device_access_volume_on.svg","icons/hardware_computer.svg","icons/hardware_dock.svg","icons/hardware_gamepad.svg","icons/hardware_headphones.svg","icons/hardware_headset.svg","icons/hardware_keyboard.svg","icons/hardware_mouse.svg","icons/hardware_phone.svg","icons/images_crop.svg","icons/images_rotate_left.svg","icons/images_rotate_right.svg","icons/images_slideshow.svg","icons/location_directions.svg","icons/location_map.svg","icons/location_place.svg","icons/location_web_site.svg","icons/navigation_accept.svg","icons/navigation_back.svg","icons/navigation_cancel.svg","icons/navigation_collapse.svg","icons/navigation_expand.svg","icons/navigation_forward.svg","icons/navigation_next_item.svg","icons/navigation_previous_item.svg","icons/navigation_refresh.svg","icons/rating_bad.svg","icons/rating_favorite.svg","icons/rating_good.svg","icons/rating_half_important.svg","icons/rating_important.svg","icons/rating_not_important.svg","icons/social_add_group.svg","icons/social_add_person.svg","icons/social_cc_bcc.svg","icons/social_chat.svg","icons/social_forward.svg","icons/social_group.svg","icons/social_person.svg","icons/social_reply.svg","icons/social_reply_all.svg","icons/social_send_now.svg","icons/social_share.svg"];b.forms.ImageField.fontList_=["Roboto","Helvetica","Arial","Georgia","Book Antiqua","Palatino","Courier","Courier New","Webdings","Wingdings"];b.forms.ImageField.loadImageFromFileList=function(d,h){d=d||[];var f=null;for(var e=0;e<d.length;e++){if(b.forms.ImageField.isValidFile_(d[e])){f=d[e];break}}if(!f){alert("Please choose a valid image file (PNG, JPG, GIF, SVG, etc.)");h(null);return}var g=a&&f.type=="image/svg+xml";var c=new FileReader();c.onload=function(i){h({uri:g?null:i.target.result,canvgSvgText:g?i.target.result:null,name:f.name})};c.onerror=function(i){switch(i.target.error.code){case i.target.error.NOT_FOUND_ERR:alert("File not found!");break;case i.target.error.NOT_READABLE_ERR:alert("File is not readable");break;case i.target.error.ABORT_ERR:break;default:alert("An error occurred reading this file.")}h(null)};c.onabort=function(i){alert("File read cancelled");h(null)};if(g){c.readAsText(f)}else{c.readAsDataURL(f)}};b.forms.ImageField.isValidFile_=function(c){return !!c.type.toLowerCase().match(/^image\//)};b.forms.ImageField.makeDropHandler_=function(d,c){return function(e){$(d).removeClass("drag-hover");c(e)}};b.forms.ImageField.makeDragoverHandler_=function(c){return function(d){c=$(c).get(0);if(c._studio_frm_dragtimeout_){window.clearTimeout(c._studio_frm_dragtimeout_);c._studio_frm_dragtimeout_=null}d.dataTransfer.dropEffect="link";d.preventDefault()}};b.forms.ImageField.makeDragenterHandler_=function(c){return function(d){c=$(c).get(0);if(c._studio_frm_dragtimeout_){window.clearTimeout(c._studio_frm_dragtimeout_);c._studio_frm_dragtimeout_=null}$(c).addClass("drag-hover");d.preventDefault()}};b.forms.ImageField.makeDragleaveHandler_=function(c){return function(d){c=$(c).get(0);if(c._studio_frm_dragtimeout_){window.clearTimeout(c._studio_frm_dragtimeout_)}c._studio_frm_dragtimeout_=window.setTimeout(function(){$(c).removeClass("drag-hover")},100)}};b.ui={};b.ui.createImageOutputGroup=function(c){return $("<div>").addClass("out-image-group").addClass(c.dark?"dark":"light").append($("<div>").addClass("label").text(c.label)).appendTo(c.container)};b.ui.createImageOutputSlot=function(c){return $("<div>").addClass("out-image-block").append($("<div>").addClass("label").text(c.label)).append($("<img>").addClass("out-image").attr("id",c.id)).appendTo(c.container)};b.ui.drawImageGuideRects=function(c,e,f){f=f||[];c.save();c.globalAlpha=0.5;c.fillStyle="#fff";c.fillRect(0,0,e.w,e.h);c.globalAlpha=1;var g=b.ui.drawImageGuideRects.guideColors_;for(var d=0;d<f.length;d++){c.strokeStyle=g[(d-1)%g.length];c.strokeRect(f[d].x+0.5,f[d].y+0.5,f[d].w-1,f[d].h-1)}c.restore()};b.ui.drawImageGuideRects.guideColors_=["#f00"];b.ui.setupDragout=function(){if(b.ui.setupDragout.completed_){return}b.ui.setupDragout.completed_=true;$(document).ready(function(){document.body.addEventListener("dragstart",function(d){var c=d.target;if(c.classList.contains("dragout")){d.dataTransfer.setData("DownloadURL",c.dataset.downloadurl)}},false)})};b.util={};b.util.getMultBaseMdpi=function(c){switch(c){case"xhdpi":return 2;case"hdpi":return 1.5;case"mdpi":return 1;case"ldpi":return 0.75}return 1};b.util.mult=function(c,e){var f={};for(k in c){f[k]=c[k]*e}return f};b.util.multRound=function(c,e){var f={};for(k in c){f[k]=Math.round(c[k]*e)}return f};b.zip={};(function(){function d(f,e){var g=";base64,";var h=window.atob(f);var m=h.length;var l=new Uint8Array(m);for(var j=0;j<m;++j){l[j]=h.charCodeAt(j)}var n=new BlobBuilder();n.append(l.buffer);return n.getBlob(e)}function c(e){if(!e.fileSpecs_.length){return""}var g=new JSZip();for(var f=0;f<e.fileSpecs_.length;f++){var h=e.fileSpecs_[f];if(h.base64data){g.add(h.name,h.base64data,{base64:true})}else{if(h.textData){g.add(h.name,h.textData)}}}return g.generate()}window.URL=window.webkitURL||window.URL;window.BlobBuilder=window.BlobBuilder||window.WebKitBlobBuilder||window.MozBlobBuilder;b.zip.createDownloadifyZipButton=function(g,f){var e={fileSpecs_:[]};var i=$("<a>").addClass("dragout").addClass("form-button").attr("disabled","disabled").text("Download .ZIP").get(0);$(g).replaceWith(i);var h=null;function j(m){if(i.href){window.URL.revokeObjectURL(i.href);i.href=null}if(!m){$(i).attr("disabled","disabled");if(h){window.clearTimeout(h)}h=window.setTimeout(function(){j(true);h=null},500);return}var l=e.zipFilename_||"output.zip";if(!e.fileSpecs_.length){return}i.download=l;i.href=window.URL.createObjectURL(d(c(e),"application/zip"));i.draggable=true;i.dataset.downloadurl=["application/zip",i.download,i.href].join(":");$(i).removeAttr("disabled")}e.setZipFilename=function(l){e.zipFilename_=l;j()};e.clear=function(){e.fileSpecs_=[];j()};e.add=function(l){e.fileSpecs_.push(l);j()};return e};b.ui.setupDragout()})();window.studio=b})();
var Base = function () {
};
Base.extend = function (b, e) {
    var f = Base.prototype.extend;
    Base._prototyping = true;
    var d = new this;
    f.call(d, b);
    delete Base._prototyping;
    var c = d.constructor;
    var a = d.constructor = function () {
        if (!Base._prototyping) {
            if (this._constructing || this.constructor == a) {
                this._constructing = true;
                c.apply(this, arguments);
                delete this._constructing
            } else {
                if (arguments[0] != null) {
                    return(arguments[0].extend || f).call(arguments[0], d)
                }
            }
        }
    };
    a.ancestor = this;
    a.extend = this.extend;
    a.forEach = this.forEach;
    a.implement = this.implement;
    a.prototype = d;
    a.toString = this.toString;
    a.valueOf = function (g) {
        return(g == "object") ? a : c.valueOf()
    };
    f.call(a, e);
    if (typeof a.init == "function") {
        a.init()
    }
    return a
};
Base.prototype = {extend: function (b, h) {
    if (arguments.length > 1) {
        var e = this[b];
        if (e && (typeof h == "function") && (!e.valueOf || e.valueOf() != h.valueOf()) && /\bbase\b/.test(h)) {
            var a = h.valueOf();
            h = function () {
                var l = this.base || Base.prototype.base;
                this.base = e;
                var i = a.apply(this, arguments);
                this.base = l;
                return i
            };
            h.valueOf = function (i) {
                return(i == "object") ? h : a
            };
            h.toString = Base.toString
        }
        this[b] = h
    } else {
        if (b) {
            var g = Base.prototype.extend;
            if (!Base._prototyping && typeof this != "function") {
                g = this.extend || g
            }
            var d = {toSource: null};
            var f = ["constructor", "toString", "valueOf"];
            var c = Base._prototyping ? 0 : 1;
            while (j = f[c++]) {
                if (b[j] != d[j]) {
                    g.call(this, j, b[j])
                }
            }
            for (var j in b) {
                if (!d[j]) {
                    g.call(this, j, b[j])
                }
            }
        }
    }
    return this
}, base: function () {
}};
Base = Base.extend({constructor: function () {
    this.extend(arguments[0])
}}, {ancestor: Object, version: "1.1", forEach: function (a, d, c) {
    for (var b in a) {
        if (this.prototype[b] === undefined) {
            d.call(c, a[b], b, a)
        }
    }
}, implement: function () {
    for (var a = 0; a < arguments.length; a++) {
        if (typeof arguments[a] == "function") {
            arguments[a](this.prototype)
        } else {
            this.prototype.extend(arguments[a])
        }
    }
    return this
}, toString: function () {
    return String(this.valueOf())
}});
(function () {
    var imagelib = {};
    var Class = {create: function () {
        var properties = arguments[0];

        function self() {
            this.initialize.apply(this, arguments)
        }

        for (var i in properties) {
            self.prototype[i] = properties[i]
        }
        if (!self.prototype.initialize) {
            self.prototype.initialize = function () {
            }
        }
        return self
    }};
    var ConvolutionFilter = Class.create({initialize: function (matrix, divisor, bias, separable) {
        this.r = (Math.sqrt(matrix.length) - 1) / 2;
        this.matrix = matrix;
        this.divisor = divisor;
        this.bias = bias;
        this.separable = separable
    }, apply: function (src, dst) {
        var w = src.width, h = src.height;
        var srcData = src.data;
        var dstData = dst.data;
        var di, si, idx;
        var r, g, b;
        for (var y = 0; y < h; ++y) {
            for (var x = 0; x < w; ++x) {
                idx = r = g = b = 0;
                di = (y * w + x) << 2;
                for (var ky = -this.r; ky <= this.r; ++ky) {
                    for (var kx = -this.r; kx <= this.r; ++kx) {
                        si = (Math.max(0, Math.min(h - 1, y + ky)) * w + Math.max(0, Math.min(w - 1, x + kx))) << 2;
                        r += srcData[si] * this.matrix[idx];
                        g += srcData[si + 1] * this.matrix[idx];
                        b += srcData[si + 2] * this.matrix[idx];
                        idx++
                    }
                }
                dstData[di] = r / this.divisor + this.bias;
                dstData[di + 1] = g / this.divisor + this.bias;
                dstData[di + 2] = b / this.divisor + this.bias;
                dstData[di + 3] = 255
            }
        }
    }});
    var fx = (function () {
        var exports = {};
        (function () {
            function supportsOESTextureFloatLinear(gl) {
                if (!gl.getExtension("OES_texture_float")) {
                    return false
                }
                var framebuffer = gl.createFramebuffer();
                var byteTexture = gl.createTexture();
                gl.bindTexture(gl.TEXTURE_2D, byteTexture);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.NEAREST);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.NEAREST);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
                gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, 1, 1, 0, gl.RGBA, gl.UNSIGNED_BYTE, null);
                gl.bindFramebuffer(gl.FRAMEBUFFER, framebuffer);
                gl.framebufferTexture2D(gl.FRAMEBUFFER, gl.COLOR_ATTACHMENT0, gl.TEXTURE_2D, byteTexture, 0);
                var rgba = [2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                var floatTexture = gl.createTexture();
                gl.bindTexture(gl.TEXTURE_2D, floatTexture);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
                gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, 2, 2, 0, gl.RGBA, gl.FLOAT, new Float32Array(rgba));
                var program = gl.createProgram();
                var vertexShader = gl.createShader(gl.VERTEX_SHADER);
                var fragmentShader = gl.createShader(gl.FRAGMENT_SHADER);
                gl.shaderSource(vertexShader, "      attribute vec2 vertex;      void main() {        gl_Position = vec4(vertex, 0.0, 1.0);      }    ");
                gl.shaderSource(fragmentShader, "      uniform sampler2D texture;      void main() {        gl_FragColor = texture2D(texture, vec2(0.5));      }    ");
                gl.compileShader(vertexShader);
                gl.compileShader(fragmentShader);
                gl.attachShader(program, vertexShader);
                gl.attachShader(program, fragmentShader);
                gl.linkProgram(program);
                var buffer = gl.createBuffer();
                gl.bindBuffer(gl.ARRAY_BUFFER, buffer);
                gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([0, 0]), gl.STREAM_DRAW);
                gl.enableVertexAttribArray(0);
                gl.vertexAttribPointer(0, 2, gl.FLOAT, false, 0, 0);
                var pixel = new Uint8Array(4);
                gl.useProgram(program);
                gl.viewport(0, 0, 1, 1);
                gl.bindTexture(gl.TEXTURE_2D, floatTexture);
                gl.drawArrays(gl.POINTS, 0, 1);
                gl.readPixels(0, 0, 1, 1, gl.RGBA, gl.UNSIGNED_BYTE, pixel);
                return pixel[0] === 127 || pixel[0] === 128
            }

            function OESTextureFloatLinear() {
            }

            function getOESTextureFloatLinear(gl) {
                if (gl.$OES_texture_float_linear$ === void 0) {
                    Object.defineProperty(gl, "$OES_texture_float_linear$", {enumerable: false, configurable: false, writable: false, value: new OESTextureFloatLinear()})
                }
                return gl.$OES_texture_float_linear$
            }

            function getExtension(name) {
                return name === "OES_texture_float_linear" ? getOESTextureFloatLinear(this) : oldGetExtension.call(this, name)
            }

            function getSupportedExtensions() {
                var extensions = oldGetSupportedExtensions.call(this);
                if (extensions.indexOf("OES_texture_float_linear") === -1) {
                    extensions.push("OES_texture_float_linear")
                }
                return extensions
            }

            try {
                var gl = document.createElement("canvas").getContext("experimental-webgl")
            } catch (e) {
            }
            if (!gl || gl.getSupportedExtensions().indexOf("OES_texture_float_linear") !== -1) {
                return
            }
            if (supportsOESTextureFloatLinear(gl)) {
                var oldGetExtension = WebGLRenderingContext.prototype.getExtension;
                var oldGetSupportedExtensions = WebGLRenderingContext.prototype.getSupportedExtensions;
                WebGLRenderingContext.prototype.getExtension = getExtension;
                WebGLRenderingContext.prototype.getSupportedExtensions = getSupportedExtensions
            }
        }());
        var gl;

        function clamp(lo, value, hi) {
            return Math.max(lo, Math.min(value, hi))
        }

        function wrapTexture(texture) {
            return{_: texture, loadContentsOf: function (element) {
                gl = this._.gl;
                this._.loadContentsOf(element)
            }, destroy: function () {
                gl = this._.gl;
                this._.destroy()
            }}
        }

        function texture(element) {
            return wrapTexture(Texture.fromElement(element))
        }

        function initialize(width, height) {
            var type = gl.UNSIGNED_BYTE;
            if (gl.getExtension("OES_texture_float") && gl.getExtension("OES_texture_float_linear")) {
                var testTexture = new Texture(100, 100, gl.RGBA, gl.FLOAT);
                try {
                    testTexture.drawTo(function () {
                        type = gl.FLOAT
                    })
                } catch (e) {
                }
                testTexture.destroy()
            }
            if (this._.texture) {
                this._.texture.destroy()
            }
            if (this._.spareTexture) {
                this._.spareTexture.destroy()
            }
            this.width = width;
            this.height = height;
            this._.texture = new Texture(width, height, gl.RGBA, type);
            this._.spareTexture = new Texture(width, height, gl.RGBA, type);
            this._.extraTexture = this._.extraTexture || new Texture(0, 0, gl.RGBA, type);
            this._.flippedShader = this._.flippedShader || new Shader(null, "        uniform sampler2D texture;        varying vec2 texCoord;        void main() {            gl_FragColor = texture2D(texture, vec2(texCoord.x, 1.0 - texCoord.y));        }    ");
            this._.isInitialized = true
        }

        function draw(texture, width, height) {
            if (!this._.isInitialized || texture._.width != this.width || texture._.height != this.height) {
                initialize.call(this, width ? width : texture._.width, height ? height : texture._.height)
            }
            texture._.use();
            this._.texture.drawTo(function () {
                Shader.getDefaultShader().drawRect()
            });
            return this
        }

        function update() {
            this._.texture.use();
            this._.flippedShader.drawRect();
            return this
        }

        function simpleShader(shader, uniforms, textureIn, textureOut) {
            (textureIn || this._.texture).use();
            this._.spareTexture.drawTo(function () {
                shader.uniforms(uniforms).drawRect()
            });
            this._.spareTexture.swapWith(textureOut || this._.texture)
        }

        function replace(node) {
            node.parentNode.insertBefore(this, node);
            node.parentNode.removeChild(node);
            return this
        }

        function contents() {
            var texture = new Texture(this._.texture.width, this._.texture.height, gl.RGBA, gl.UNSIGNED_BYTE);
            this._.texture.use();
            texture.drawTo(function () {
                Shader.getDefaultShader().drawRect()
            });
            return wrapTexture(texture)
        }

        function getPixelArray() {
            var w = this._.texture.width;
            var h = this._.texture.height;
            var array = new Uint8Array(w * h * 4);
            this._.texture.drawTo(function () {
                gl.readPixels(0, 0, w, h, gl.RGBA, gl.UNSIGNED_BYTE, array)
            });
            return array
        }

        function wrap(func) {
            return function () {
                gl = this._.gl;
                return func.apply(this, arguments)
            }
        }

        exports.canvas = function () {
            var canvas = document.createElement("canvas");
            try {
                gl = canvas.getContext("experimental-webgl", {premultipliedAlpha: false})
            } catch (e) {
                gl = null
            }
            if (!gl) {
                throw"This browser does not support WebGL"
            }
            canvas._ = {gl: gl, isInitialized: false, texture: null, spareTexture: null, flippedShader: null};
            canvas.texture = wrap(texture);
            canvas.draw = wrap(draw);
            canvas.update = wrap(update);
            canvas.replace = wrap(replace);
            canvas.contents = wrap(contents);
            canvas.getPixelArray = wrap(getPixelArray);
            canvas.brightnessContrast = wrap(brightnessContrast);
            canvas.hexagonalPixelate = wrap(hexagonalPixelate);
            canvas.hueSaturation = wrap(hueSaturation);
            canvas.colorHalftone = wrap(colorHalftone);
            canvas.triangleBlur = wrap(triangleBlur);
            canvas.unsharpMask = wrap(unsharpMask);
            canvas.perspective = wrap(perspective);
            canvas.matrixWarp = wrap(matrixWarp);
            canvas.bulgePinch = wrap(bulgePinch);
            canvas.tiltShift = wrap(tiltShift);
            canvas.dotScreen = wrap(dotScreen);
            canvas.edgeWork = wrap(edgeWork);
            canvas.lensBlur = wrap(lensBlur);
            canvas.zoomBlur = wrap(zoomBlur);
            canvas.noise = wrap(noise);
            canvas.denoise = wrap(denoise);
            canvas.curves = wrap(curves);
            canvas.swirl = wrap(swirl);
            canvas.ink = wrap(ink);
            canvas.vignette = wrap(vignette);
            canvas.vibrance = wrap(vibrance);
            canvas.sepia = wrap(sepia);
            return canvas
        };
        exports.splineInterpolate = splineInterpolate;
        function getSquareToQuad(x0, y0, x1, y1, x2, y2, x3, y3) {
            var dx1 = x1 - x2;
            var dy1 = y1 - y2;
            var dx2 = x3 - x2;
            var dy2 = y3 - y2;
            var dx3 = x0 - x1 + x2 - x3;
            var dy3 = y0 - y1 + y2 - y3;
            var det = dx1 * dy2 - dx2 * dy1;
            var a = (dx3 * dy2 - dx2 * dy3) / det;
            var b = (dx1 * dy3 - dx3 * dy1) / det;
            return[x1 - x0 + a * x1, y1 - y0 + a * y1, a, x3 - x0 + b * x3, y3 - y0 + b * y3, b, x0, y0, 1]
        }

        function getInverse(m) {
            var a = m[0], b = m[1], c = m[2];
            var d = m[3], e = m[4], f = m[5];
            var g = m[6], h = m[7], i = m[8];
            var det = a * e * i - a * f * h - b * d * i + b * f * g + c * d * h - c * e * g;
            return[(e * i - f * h) / det, (c * h - b * i) / det, (b * f - c * e) / det, (f * g - d * i) / det, (a * i - c * g) / det, (c * d - a * f) / det, (d * h - e * g) / det, (b * g - a * h) / det, (a * e - b * d) / det]
        }

        function multiply(a, b) {
            return[a[0] * b[0] + a[1] * b[3] + a[2] * b[6], a[0] * b[1] + a[1] * b[4] + a[2] * b[7], a[0] * b[2] + a[1] * b[5] + a[2] * b[8], a[3] * b[0] + a[4] * b[3] + a[5] * b[6], a[3] * b[1] + a[4] * b[4] + a[5] * b[7], a[3] * b[2] + a[4] * b[5] + a[5] * b[8], a[6] * b[0] + a[7] * b[3] + a[8] * b[6], a[6] * b[1] + a[7] * b[4] + a[8] * b[7], a[6] * b[2] + a[7] * b[5] + a[8] * b[8]]
        }

        var Shader = (function () {
            function isArray(obj) {
                return Object.prototype.toString.call(obj) == "[object Array]"
            }

            function isNumber(obj) {
                return Object.prototype.toString.call(obj) == "[object Number]"
            }

            function compileSource(type, source) {
                var shader = gl.createShader(type);
                gl.shaderSource(shader, source);
                gl.compileShader(shader);
                if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
                    throw"compile error: " + gl.getShaderInfoLog(shader)
                }
                return shader
            }

            var defaultVertexSource = "    attribute vec2 vertex;    attribute vec2 _texCoord;    varying vec2 texCoord;    void main() {        texCoord = _texCoord;        gl_Position = vec4(vertex * 2.0 - 1.0, 0.0, 1.0);    }";
            var defaultFragmentSource = "    uniform sampler2D texture;    varying vec2 texCoord;    void main() {        gl_FragColor = texture2D(texture, texCoord);    }";

            function Shader(vertexSource, fragmentSource) {
                this.vertexAttribute = null;
                this.texCoordAttribute = null;
                this.program = gl.createProgram();
                vertexSource = vertexSource || defaultVertexSource;
                fragmentSource = fragmentSource || defaultFragmentSource;
                fragmentSource = "precision highp float;" + fragmentSource;
                gl.attachShader(this.program, compileSource(gl.VERTEX_SHADER, vertexSource));
                gl.attachShader(this.program, compileSource(gl.FRAGMENT_SHADER, fragmentSource));
                gl.linkProgram(this.program);
                if (!gl.getProgramParameter(this.program, gl.LINK_STATUS)) {
                    throw"link error: " + gl.getProgramInfoLog(this.program)
                }
            }

            Shader.prototype.destroy = function () {
                gl.deleteProgram(this.program);
                this.program = null
            };
            Shader.prototype.uniforms = function (uniforms) {
                gl.useProgram(this.program);
                for (var name in uniforms) {
                    if (!uniforms.hasOwnProperty(name)) {
                        continue
                    }
                    var location = gl.getUniformLocation(this.program, name);
                    if (location === null) {
                        continue
                    }
                    var value = uniforms[name];
                    if (isArray(value)) {
                        switch (value.length) {
                            case 1:
                                gl.uniform1fv(location, new Float32Array(value));
                                break;
                            case 2:
                                gl.uniform2fv(location, new Float32Array(value));
                                break;
                            case 3:
                                gl.uniform3fv(location, new Float32Array(value));
                                break;
                            case 4:
                                gl.uniform4fv(location, new Float32Array(value));
                                break;
                            case 9:
                                gl.uniformMatrix3fv(location, false, new Float32Array(value));
                                break;
                            case 16:
                                gl.uniformMatrix4fv(location, false, new Float32Array(value));
                                break;
                            default:
                                throw"dont't know how to load uniform \"" + name + '" of length ' + value.length
                        }
                    } else {
                        if (isNumber(value)) {
                            gl.uniform1f(location, value)
                        } else {
                            throw'attempted to set uniform "' + name + '" to invalid value ' + (value || "undefined").toString()
                        }
                    }
                }
                return this
            };
            Shader.prototype.textures = function (textures) {
                gl.useProgram(this.program);
                for (var name in textures) {
                    if (!textures.hasOwnProperty(name)) {
                        continue
                    }
                    gl.uniform1i(gl.getUniformLocation(this.program, name), textures[name])
                }
                return this
            };
            Shader.prototype.drawRect = function (left, top, right, bottom) {
                var undefined;
                var viewport = gl.getParameter(gl.VIEWPORT);
                top = top !== undefined ? (top - viewport[1]) / viewport[3] : 0;
                left = left !== undefined ? (left - viewport[0]) / viewport[2] : 0;
                right = right !== undefined ? (right - viewport[0]) / viewport[2] : 1;
                bottom = bottom !== undefined ? (bottom - viewport[1]) / viewport[3] : 1;
                if (gl.vertexBuffer == null) {
                    gl.vertexBuffer = gl.createBuffer()
                }
                gl.bindBuffer(gl.ARRAY_BUFFER, gl.vertexBuffer);
                gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([left, top, left, bottom, right, top, right, bottom]), gl.STATIC_DRAW);
                if (gl.texCoordBuffer == null) {
                    gl.texCoordBuffer = gl.createBuffer();
                    gl.bindBuffer(gl.ARRAY_BUFFER, gl.texCoordBuffer);
                    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([0, 0, 0, 1, 1, 0, 1, 1]), gl.STATIC_DRAW)
                }
                if (this.vertexAttribute == null) {
                    this.vertexAttribute = gl.getAttribLocation(this.program, "vertex");
                    gl.enableVertexAttribArray(this.vertexAttribute)
                }
                if (this.texCoordAttribute == null) {
                    this.texCoordAttribute = gl.getAttribLocation(this.program, "_texCoord");
                    gl.enableVertexAttribArray(this.texCoordAttribute)
                }
                gl.useProgram(this.program);
                gl.bindBuffer(gl.ARRAY_BUFFER, gl.vertexBuffer);
                gl.vertexAttribPointer(this.vertexAttribute, 2, gl.FLOAT, false, 0, 0);
                gl.bindBuffer(gl.ARRAY_BUFFER, gl.texCoordBuffer);
                gl.vertexAttribPointer(this.texCoordAttribute, 2, gl.FLOAT, false, 0, 0);
                gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4)
            };
            Shader.getDefaultShader = function () {
                gl.defaultShader = gl.defaultShader || new Shader();
                return gl.defaultShader
            };
            return Shader
        })();

        function SplineInterpolator(points) {
            var n = points.length;
            this.xa = [];
            this.ya = [];
            this.u = [];
            this.y2 = [];
            points.sort(function (a, b) {
                return a[0] - b[0]
            });
            for (var i = 0; i < n; i++) {
                this.xa.push(points[i][0]);
                this.ya.push(points[i][1])
            }
            this.u[0] = 0;
            this.y2[0] = 0;
            for (var i = 1; i < n - 1; ++i) {
                var wx = this.xa[i + 1] - this.xa[i - 1];
                var sig = (this.xa[i] - this.xa[i - 1]) / wx;
                var p = sig * this.y2[i - 1] + 2;
                this.y2[i] = (sig - 1) / p;
                var ddydx = (this.ya[i + 1] - this.ya[i]) / (this.xa[i + 1] - this.xa[i]) - (this.ya[i] - this.ya[i - 1]) / (this.xa[i] - this.xa[i - 1]);
                this.u[i] = (6 * ddydx / wx - sig * this.u[i - 1]) / p
            }
            this.y2[n - 1] = 0;
            for (var i = n - 2; i >= 0; --i) {
                this.y2[i] = this.y2[i] * this.y2[i + 1] + this.u[i]
            }
        }

        SplineInterpolator.prototype.interpolate = function (x) {
            var n = this.ya.length;
            var klo = 0;
            var khi = n - 1;
            while (khi - klo > 1) {
                var k = (khi + klo) >> 1;
                if (this.xa[k] > x) {
                    khi = k
                } else {
                    klo = k
                }
            }
            var h = this.xa[khi] - this.xa[klo];
            var a = (this.xa[khi] - x) / h;
            var b = (x - this.xa[klo]) / h;
            return a * this.ya[klo] + b * this.ya[khi] + ((a * a * a - a) * this.y2[klo] + (b * b * b - b) * this.y2[khi]) * (h * h) / 6
        };
        var Texture = (function () {
            Texture.fromElement = function (element) {
                var texture = new Texture(0, 0, gl.RGBA, gl.UNSIGNED_BYTE);
                texture.loadContentsOf(element);
                return texture
            };
            function Texture(width, height, format, type) {
                this.gl = gl;
                this.id = gl.createTexture();
                this.width = width;
                this.height = height;
                this.format = format;
                this.type = type;
                gl.bindTexture(gl.TEXTURE_2D, this.id);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
                if (width && height) {
                    gl.texImage2D(gl.TEXTURE_2D, 0, this.format, width, height, 0, this.format, this.type, null)
                }
            }

            Texture.prototype.loadContentsOf = function (element) {
                this.width = element.width || element.videoWidth;
                this.height = element.height || element.videoHeight;
                gl.bindTexture(gl.TEXTURE_2D, this.id);
                gl.texImage2D(gl.TEXTURE_2D, 0, this.format, this.format, this.type, element)
            };
            Texture.prototype.initFromBytes = function (width, height, data) {
                this.width = width;
                this.height = height;
                this.format = gl.RGBA;
                this.type = gl.UNSIGNED_BYTE;
                gl.bindTexture(gl.TEXTURE_2D, this.id);
                gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, width, height, 0, gl.RGBA, this.type, new Uint8Array(data))
            };
            Texture.prototype.destroy = function () {
                gl.deleteTexture(this.id);
                this.id = null
            };
            Texture.prototype.use = function (unit) {
                gl.activeTexture(gl.TEXTURE0 + (unit || 0));
                gl.bindTexture(gl.TEXTURE_2D, this.id)
            };
            Texture.prototype.unuse = function (unit) {
                gl.activeTexture(gl.TEXTURE0 + (unit || 0));
                gl.bindTexture(gl.TEXTURE_2D, null)
            };
            Texture.prototype.ensureFormat = function (width, height, format, type) {
                if (arguments.length == 1) {
                    var texture = arguments[0];
                    width = texture.width;
                    height = texture.height;
                    format = texture.format;
                    type = texture.type
                }
                if (width != this.width || height != this.height || format != this.format || type != this.type) {
                    this.width = width;
                    this.height = height;
                    this.format = format;
                    this.type = type;
                    gl.bindTexture(gl.TEXTURE_2D, this.id);
                    gl.texImage2D(gl.TEXTURE_2D, 0, this.format, width, height, 0, this.format, this.type, null)
                }
            };
            Texture.prototype.drawTo = function (callback) {
                gl.framebuffer = gl.framebuffer || gl.createFramebuffer();
                gl.bindFramebuffer(gl.FRAMEBUFFER, gl.framebuffer);
                gl.framebufferTexture2D(gl.FRAMEBUFFER, gl.COLOR_ATTACHMENT0, gl.TEXTURE_2D, this.id, 0);
                if (gl.checkFramebufferStatus(gl.FRAMEBUFFER) !== gl.FRAMEBUFFER_COMPLETE) {
                    throw new Error("incomplete framebuffer")
                }
                gl.viewport(0, 0, this.width, this.height);
                callback();
                gl.bindFramebuffer(gl.FRAMEBUFFER, null)
            };
            var canvas = null;

            function getCanvas(texture) {
                if (canvas == null) {
                    canvas = document.createElement("canvas")
                }
                canvas.width = texture.width;
                canvas.height = texture.height;
                var c = canvas.getContext("2d");
                c.clearRect(0, 0, canvas.width, canvas.height);
                return c
            }

            Texture.prototype.fillUsingCanvas = function (callback) {
                callback(getCanvas(this));
                this.format = gl.RGBA;
                this.type = gl.UNSIGNED_BYTE;
                gl.bindTexture(gl.TEXTURE_2D, this.id);
                gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, canvas);
                return this
            };
            Texture.prototype.toImage = function (image) {
                this.use();
                Shader.getDefaultShader().drawRect();
                var size = this.width * this.height * 4;
                var pixels = new Uint8Array(size);
                var c = getCanvas(this);
                var data = c.createImageData(this.width, this.height);
                gl.readPixels(0, 0, this.width, this.height, gl.RGBA, gl.UNSIGNED_BYTE, pixels);
                for (var i = 0; i < size; i++) {
                    data.data[i] = pixels[i]
                }
                c.putImageData(data, 0, 0);
                image.src = canvas.toDataURL()
            };
            Texture.prototype.swapWith = function (other) {
                var temp;
                temp = other.id;
                other.id = this.id;
                this.id = temp;
                temp = other.width;
                other.width = this.width;
                this.width = temp;
                temp = other.height;
                other.height = this.height;
                this.height = temp;
                temp = other.format;
                other.format = this.format;
                this.format = temp
            };
            return Texture
        })();

        function warpShader(uniforms, warp) {
            return new Shader(null, uniforms + "    uniform sampler2D texture;    uniform vec2 texSize;    varying vec2 texCoord;    void main() {        vec2 coord = texCoord * texSize;        " + warp + "        gl_FragColor = texture2D(texture, coord / texSize);        vec2 clampedCoord = clamp(coord, vec2(0.0), texSize);        if (coord != clampedCoord) {            /* fade to transparent if we are outside the image */            gl_FragColor.a *= max(0.0, 1.0 - length(coord - clampedCoord));        }    }")
        }

        var randomShaderFunc = "    float random(vec3 scale, float seed) {        /* use the fragment position for a different seed per-pixel */        return fract(sin(dot(gl_FragCoord.xyz + seed, scale)) * 43758.5453 + seed);    }";

        function brightnessContrast(brightness, contrast) {
            gl.brightnessContrast = gl.brightnessContrast || new Shader(null, "        uniform sampler2D texture;        uniform float brightness;        uniform float contrast;        varying vec2 texCoord;        void main() {            vec4 color = texture2D(texture, texCoord);            color.rgb += brightness;            if (contrast > 0.0) {                color.rgb = (color.rgb - 0.5) / (1.0 - contrast) + 0.5;            } else {                color.rgb = (color.rgb - 0.5) * (1.0 + contrast) + 0.5;            }            gl_FragColor = color;        }    ");
            simpleShader.call(this, gl.brightnessContrast, {brightness: clamp(-1, brightness, 1), contrast: clamp(-1, contrast, 1)});
            return this
        }

        function splineInterpolate(points) {
            var interpolator = new SplineInterpolator(points);
            var array = [];
            for (var i = 0; i < 256; i++) {
                array.push(clamp(0, Math.floor(interpolator.interpolate(i / 255) * 256), 255))
            }
            return array
        }

        function curves(red, green, blue) {
            red = splineInterpolate(red);
            if (arguments.length == 1) {
                green = blue = red
            } else {
                green = splineInterpolate(green);
                blue = splineInterpolate(blue)
            }
            var array = [];
            for (var i = 0; i < 256; i++) {
                array.splice(array.length, 0, red[i], green[i], blue[i], 255)
            }
            this._.extraTexture.initFromBytes(256, 1, array);
            this._.extraTexture.use(1);
            gl.curves = gl.curves || new Shader(null, "        uniform sampler2D texture;        uniform sampler2D map;        varying vec2 texCoord;        void main() {            vec4 color = texture2D(texture, texCoord);            color.r = texture2D(map, vec2(color.r)).r;            color.g = texture2D(map, vec2(color.g)).g;            color.b = texture2D(map, vec2(color.b)).b;            gl_FragColor = color;        }    ");
            gl.curves.textures({map: 1});
            simpleShader.call(this, gl.curves, {});
            return this
        }

        function denoise(exponent) {
            gl.denoise = gl.denoise || new Shader(null, "        uniform sampler2D texture;        uniform float exponent;        uniform float strength;        uniform vec2 texSize;        varying vec2 texCoord;        void main() {            vec4 center = texture2D(texture, texCoord);            vec4 color = vec4(0.0);            float total = 0.0;            for (float x = -4.0; x <= 4.0; x += 1.0) {                for (float y = -4.0; y <= 4.0; y += 1.0) {                    vec4 sample = texture2D(texture, texCoord + vec2(x, y) / texSize);                    float weight = 1.0 - abs(dot(sample.rgb - center.rgb, vec3(0.25)));                    weight = pow(weight, exponent);                    color += sample * weight;                    total += weight;                }            }            gl_FragColor = color / total;        }    ");
            for (var i = 0; i < 2; i++) {
                simpleShader.call(this, gl.denoise, {exponent: Math.max(0, exponent), texSize: [this.width, this.height]})
            }
            return this
        }

        function hueSaturation(hue, saturation) {
            gl.hueSaturation = gl.hueSaturation || new Shader(null, "        uniform sampler2D texture;        uniform float hue;        uniform float saturation;        varying vec2 texCoord;        void main() {            vec4 color = texture2D(texture, texCoord);                        /* hue adjustment, wolfram alpha: RotationTransform[angle, {1, 1, 1}][{x, y, z}] */            float angle = hue * 3.14159265;            float s = sin(angle), c = cos(angle);            vec3 weights = (vec3(2.0 * c, -sqrt(3.0) * s - c, sqrt(3.0) * s - c) + 1.0) / 3.0;            float len = length(color.rgb);            color.rgb = vec3(                dot(color.rgb, weights.xyz),                dot(color.rgb, weights.zxy),                dot(color.rgb, weights.yzx)            );                        /* saturation adjustment */            float average = (color.r + color.g + color.b) / 3.0;            if (saturation > 0.0) {                color.rgb += (average - color.rgb) * (1.0 - 1.0 / (1.001 - saturation));            } else {                color.rgb += (average - color.rgb) * (-saturation);            }                        gl_FragColor = color;        }    ");
            simpleShader.call(this, gl.hueSaturation, {hue: clamp(-1, hue, 1), saturation: clamp(-1, saturation, 1)});
            return this
        }

        function noise(amount) {
            gl.noise = gl.noise || new Shader(null, "        uniform sampler2D texture;        uniform float amount;        varying vec2 texCoord;        float rand(vec2 co) {            return fract(sin(dot(co.xy ,vec2(12.9898,78.233))) * 43758.5453);        }        void main() {            vec4 color = texture2D(texture, texCoord);                        float diff = (rand(texCoord) - 0.5) * amount;            color.r += diff;            color.g += diff;            color.b += diff;                        gl_FragColor = color;        }    ");
            simpleShader.call(this, gl.noise, {amount: clamp(0, amount, 1)});
            return this
        }

        function sepia(amount) {
            gl.sepia = gl.sepia || new Shader(null, "        uniform sampler2D texture;        uniform float amount;        varying vec2 texCoord;        void main() {            vec4 color = texture2D(texture, texCoord);            float r = color.r;            float g = color.g;            float b = color.b;                        color.r = min(1.0, (r * (1.0 - (0.607 * amount))) + (g * (0.769 * amount)) + (b * (0.189 * amount)));            color.g = min(1.0, (r * 0.349 * amount) + (g * (1.0 - (0.314 * amount))) + (b * 0.168 * amount));            color.b = min(1.0, (r * 0.272 * amount) + (g * 0.534 * amount) + (b * (1.0 - (0.869 * amount))));                        gl_FragColor = color;        }    ");
            simpleShader.call(this, gl.sepia, {amount: clamp(0, amount, 1)});
            return this
        }

        function unsharpMask(radius, strength) {
            gl.unsharpMask = gl.unsharpMask || new Shader(null, "        uniform sampler2D blurredTexture;        uniform sampler2D originalTexture;        uniform float strength;        uniform float threshold;        varying vec2 texCoord;        void main() {            vec4 blurred = texture2D(blurredTexture, texCoord);            vec4 original = texture2D(originalTexture, texCoord);            gl_FragColor = mix(blurred, original, 1.0 + strength);        }    ");
            this._.extraTexture.ensureFormat(this._.texture);
            this._.texture.use();
            this._.extraTexture.drawTo(function () {
                Shader.getDefaultShader().drawRect()
            });
            this._.extraTexture.use(1);
            this.triangleBlur(radius);
            gl.unsharpMask.textures({originalTexture: 1});
            simpleShader.call(this, gl.unsharpMask, {strength: strength});
            this._.extraTexture.unuse(1);
            return this
        }

        function vibrance(amount) {
            gl.vibrance = gl.vibrance || new Shader(null, "        uniform sampler2D texture;        uniform float amount;        varying vec2 texCoord;        void main() {            vec4 color = texture2D(texture, texCoord);            float average = (color.r + color.g + color.b) / 3.0;            float mx = max(color.r, max(color.g, color.b));            float amt = (mx - average) * (-amount * 3.0);            color.rgb = mix(color.rgb, vec3(mx), amt);            gl_FragColor = color;        }    ");
            simpleShader.call(this, gl.vibrance, {amount: clamp(-1, amount, 1)});
            return this
        }

        function vignette(size, amount) {
            gl.vignette = gl.vignette || new Shader(null, "        uniform sampler2D texture;        uniform float size;        uniform float amount;        varying vec2 texCoord;        void main() {            vec4 color = texture2D(texture, texCoord);                        float dist = distance(texCoord, vec2(0.5, 0.5));            color.rgb *= smoothstep(0.8, size * 0.799, dist * (amount + size));                        gl_FragColor = color;        }    ");
            simpleShader.call(this, gl.vignette, {size: clamp(0, size, 1), amount: clamp(0, amount, 1)});
            return this
        }

        function lensBlur(radius, brightness, angle) {
            gl.lensBlurPrePass = gl.lensBlurPrePass || new Shader(null, "        uniform sampler2D texture;        uniform float power;        varying vec2 texCoord;        void main() {            vec4 color = texture2D(texture, texCoord);            color = pow(color, vec4(power));            gl_FragColor = vec4(color);        }    ");
            var common = "        uniform sampler2D texture0;        uniform sampler2D texture1;        uniform vec2 delta0;        uniform vec2 delta1;        uniform float power;        varying vec2 texCoord;        " + randomShaderFunc + "        vec4 sample(vec2 delta) {            /* randomize the lookup values to hide the fixed number of samples */            float offset = random(vec3(delta, 151.7182), 0.0);                        vec4 color = vec4(0.0);            float total = 0.0;            for (float t = 0.0; t <= 30.0; t++) {                float percent = (t + offset) / 30.0;                color += texture2D(texture0, texCoord + delta * percent);                total += 1.0;            }            return color / total;        }    ";
            gl.lensBlur0 = gl.lensBlur0 || new Shader(null, common + "        void main() {            gl_FragColor = sample(delta0);        }    ");
            gl.lensBlur1 = gl.lensBlur1 || new Shader(null, common + "        void main() {            gl_FragColor = (sample(delta0) + sample(delta1)) * 0.5;        }    ");
            gl.lensBlur2 = gl.lensBlur2 || new Shader(null, common + "        void main() {            vec4 color = (sample(delta0) + 2.0 * texture2D(texture1, texCoord)) / 3.0;            gl_FragColor = pow(color, vec4(power));        }    ").textures({texture1: 1});
            var dir = [];
            for (var i = 0; i < 3; i++) {
                var a = angle + i * Math.PI * 2 / 3;
                dir.push([radius * Math.sin(a) / this.width, radius * Math.cos(a) / this.height])
            }
            var power = Math.pow(10, clamp(-1, brightness, 1));
            simpleShader.call(this, gl.lensBlurPrePass, {power: power});
            this._.extraTexture.ensureFormat(this._.texture);
            simpleShader.call(this, gl.lensBlur0, {delta0: dir[0]}, this._.texture, this._.extraTexture);
            simpleShader.call(this, gl.lensBlur1, {delta0: dir[1], delta1: dir[2]}, this._.extraTexture, this._.extraTexture);
            simpleShader.call(this, gl.lensBlur0, {delta0: dir[1]});
            this._.extraTexture.use(1);
            simpleShader.call(this, gl.lensBlur2, {power: 1 / power, delta0: dir[2]});
            return this
        }

        function tiltShift(startX, startY, endX, endY, blurRadius, gradientRadius) {
            gl.tiltShift = gl.tiltShift || new Shader(null, "        uniform sampler2D texture;        uniform float blurRadius;        uniform float gradientRadius;        uniform vec2 start;        uniform vec2 end;        uniform vec2 delta;        uniform vec2 texSize;        varying vec2 texCoord;        " + randomShaderFunc + "        void main() {            vec4 color = vec4(0.0);            float total = 0.0;                        /* randomize the lookup values to hide the fixed number of samples */            float offset = random(vec3(12.9898, 78.233, 151.7182), 0.0);                        vec2 normal = normalize(vec2(start.y - end.y, end.x - start.x));            float radius = smoothstep(0.0, 1.0, abs(dot(texCoord * texSize - start, normal)) / gradientRadius) * blurRadius;            for (float t = -30.0; t <= 30.0; t++) {                float percent = (t + offset - 0.5) / 30.0;                float weight = 1.0 - abs(percent);                vec4 sample = texture2D(texture, texCoord + delta / texSize * percent * radius);                                /* switch to pre-multiplied alpha to correctly blur transparent images */                sample.rgb *= sample.a;                                color += sample * weight;                total += weight;            }                        gl_FragColor = color / total;                        /* switch back from pre-multiplied alpha */            gl_FragColor.rgb /= gl_FragColor.a + 0.00001;        }    ");
            var dx = endX - startX;
            var dy = endY - startY;
            var d = Math.sqrt(dx * dx + dy * dy);
            simpleShader.call(this, gl.tiltShift, {blurRadius: blurRadius, gradientRadius: gradientRadius, start: [startX, startY], end: [endX, endY], delta: [dx / d, dy / d], texSize: [this.width, this.height]});
            simpleShader.call(this, gl.tiltShift, {blurRadius: blurRadius, gradientRadius: gradientRadius, start: [startX, startY], end: [endX, endY], delta: [-dy / d, dx / d], texSize: [this.width, this.height]});
            return this
        }

        function triangleBlur(radius) {
            gl.triangleBlur = gl.triangleBlur || new Shader(null, "        uniform sampler2D texture;        uniform vec2 delta;        varying vec2 texCoord;        " + randomShaderFunc + "        void main() {            vec4 color = vec4(0.0);            float total = 0.0;                        /* randomize the lookup values to hide the fixed number of samples */            float offset = random(vec3(12.9898, 78.233, 151.7182), 0.0);                        for (float t = -30.0; t <= 30.0; t++) {                float percent = (t + offset - 0.5) / 30.0;                float weight = 1.0 - abs(percent);                vec4 sample = texture2D(texture, texCoord + delta * percent);                                /* switch to pre-multiplied alpha to correctly blur transparent images */                sample.rgb *= sample.a;                                color += sample * weight;                total += weight;            }                        gl_FragColor = color / total;                        /* switch back from pre-multiplied alpha */            gl_FragColor.rgb /= gl_FragColor.a + 0.00001;        }    ");
            simpleShader.call(this, gl.triangleBlur, {delta: [radius / this.width, 0]});
            simpleShader.call(this, gl.triangleBlur, {delta: [0, radius / this.height]});
            return this
        }

        function zoomBlur(centerX, centerY, strength) {
            gl.zoomBlur = gl.zoomBlur || new Shader(null, "        uniform sampler2D texture;        uniform vec2 center;        uniform float strength;        uniform vec2 texSize;        varying vec2 texCoord;        " + randomShaderFunc + "        void main() {            vec4 color = vec4(0.0);            float total = 0.0;            vec2 toCenter = center - texCoord * texSize;                        /* randomize the lookup values to hide the fixed number of samples */            float offset = random(vec3(12.9898, 78.233, 151.7182), 0.0);                        for (float t = 0.0; t <= 40.0; t++) {                float percent = (t + offset) / 40.0;                float weight = 4.0 * (percent - percent * percent);                vec4 sample = texture2D(texture, texCoord + toCenter * percent * strength / texSize);                                /* switch to pre-multiplied alpha to correctly blur transparent images */                sample.rgb *= sample.a;                                color += sample * weight;                total += weight;            }                        gl_FragColor = color / total;                        /* switch back from pre-multiplied alpha */            gl_FragColor.rgb /= gl_FragColor.a + 0.00001;        }    ");
            simpleShader.call(this, gl.zoomBlur, {center: [centerX, centerY], strength: strength, texSize: [this.width, this.height]});
            return this
        }

        function colorHalftone(centerX, centerY, angle, size) {
            gl.colorHalftone = gl.colorHalftone || new Shader(null, "        uniform sampler2D texture;        uniform vec2 center;        uniform float angle;        uniform float scale;        uniform vec2 texSize;        varying vec2 texCoord;                float pattern(float angle) {            float s = sin(angle), c = cos(angle);            vec2 tex = texCoord * texSize - center;            vec2 point = vec2(                c * tex.x - s * tex.y,                s * tex.x + c * tex.y            ) * scale;            return (sin(point.x) * sin(point.y)) * 4.0;        }                void main() {            vec4 color = texture2D(texture, texCoord);            vec3 cmy = 1.0 - color.rgb;            float k = min(cmy.x, min(cmy.y, cmy.z));            cmy = (cmy - k) / (1.0 - k);            cmy = clamp(cmy * 10.0 - 3.0 + vec3(pattern(angle + 0.26179), pattern(angle + 1.30899), pattern(angle)), 0.0, 1.0);            k = clamp(k * 10.0 - 5.0 + pattern(angle + 0.78539), 0.0, 1.0);            gl_FragColor = vec4(1.0 - cmy - k, color.a);        }    ");
            simpleShader.call(this, gl.colorHalftone, {center: [centerX, centerY], angle: angle, scale: Math.PI / size, texSize: [this.width, this.height]});
            return this
        }

        function dotScreen(centerX, centerY, angle, size) {
            gl.dotScreen = gl.dotScreen || new Shader(null, "        uniform sampler2D texture;        uniform vec2 center;        uniform float angle;        uniform float scale;        uniform vec2 texSize;        varying vec2 texCoord;                float pattern() {            float s = sin(angle), c = cos(angle);            vec2 tex = texCoord * texSize - center;            vec2 point = vec2(                c * tex.x - s * tex.y,                s * tex.x + c * tex.y            ) * scale;            return (sin(point.x) * sin(point.y)) * 4.0;        }                void main() {            vec4 color = texture2D(texture, texCoord);            float average = (color.r + color.g + color.b) / 3.0;            gl_FragColor = vec4(vec3(average * 10.0 - 5.0 + pattern()), color.a);        }    ");
            simpleShader.call(this, gl.dotScreen, {center: [centerX, centerY], angle: angle, scale: Math.PI / size, texSize: [this.width, this.height]});
            return this
        }

        function edgeWork(radius) {
            gl.edgeWork1 = gl.edgeWork1 || new Shader(null, "        uniform sampler2D texture;        uniform vec2 delta;        varying vec2 texCoord;        " + randomShaderFunc + "        void main() {            vec2 color = vec2(0.0);            vec2 total = vec2(0.0);                        /* randomize the lookup values to hide the fixed number of samples */            float offset = random(vec3(12.9898, 78.233, 151.7182), 0.0);                        for (float t = -30.0; t <= 30.0; t++) {                float percent = (t + offset - 0.5) / 30.0;                float weight = 1.0 - abs(percent);                vec3 sample = texture2D(texture, texCoord + delta * percent).rgb;                float average = (sample.r + sample.g + sample.b) / 3.0;                color.x += average * weight;                total.x += weight;                if (abs(t) < 15.0) {                    weight = weight * 2.0 - 1.0;                    color.y += average * weight;                    total.y += weight;                }            }            gl_FragColor = vec4(color / total, 0.0, 1.0);        }    ");
            gl.edgeWork2 = gl.edgeWork2 || new Shader(null, "        uniform sampler2D texture;        uniform vec2 delta;        varying vec2 texCoord;        " + randomShaderFunc + "        void main() {            vec2 color = vec2(0.0);            vec2 total = vec2(0.0);                        /* randomize the lookup values to hide the fixed number of samples */            float offset = random(vec3(12.9898, 78.233, 151.7182), 0.0);                        for (float t = -30.0; t <= 30.0; t++) {                float percent = (t + offset - 0.5) / 30.0;                float weight = 1.0 - abs(percent);                vec2 sample = texture2D(texture, texCoord + delta * percent).xy;                color.x += sample.x * weight;                total.x += weight;                if (abs(t) < 15.0) {                    weight = weight * 2.0 - 1.0;                    color.y += sample.y * weight;                    total.y += weight;                }            }            float c = clamp(10000.0 * (color.y / total.y - color.x / total.x) + 0.5, 0.0, 1.0);            gl_FragColor = vec4(c, c, c, 1.0);        }    ");
            simpleShader.call(this, gl.edgeWork1, {delta: [radius / this.width, 0]});
            simpleShader.call(this, gl.edgeWork2, {delta: [0, radius / this.height]});
            return this
        }

        function hexagonalPixelate(centerX, centerY, scale) {
            gl.hexagonalPixelate = gl.hexagonalPixelate || new Shader(null, "        uniform sampler2D texture;        uniform vec2 center;        uniform float scale;        uniform vec2 texSize;        varying vec2 texCoord;        void main() {            vec2 tex = (texCoord * texSize - center) / scale;            tex.y /= 0.866025404;            tex.x -= tex.y * 0.5;                        vec2 a;            if (tex.x + tex.y - floor(tex.x) - floor(tex.y) < 1.0) a = vec2(floor(tex.x), floor(tex.y));            else a = vec2(ceil(tex.x), ceil(tex.y));            vec2 b = vec2(ceil(tex.x), floor(tex.y));            vec2 c = vec2(floor(tex.x), ceil(tex.y));                        vec3 TEX = vec3(tex.x, tex.y, 1.0 - tex.x - tex.y);            vec3 A = vec3(a.x, a.y, 1.0 - a.x - a.y);            vec3 B = vec3(b.x, b.y, 1.0 - b.x - b.y);            vec3 C = vec3(c.x, c.y, 1.0 - c.x - c.y);                        float alen = length(TEX - A);            float blen = length(TEX - B);            float clen = length(TEX - C);                        vec2 choice;            if (alen < blen) {                if (alen < clen) choice = a;                else choice = c;            } else {                if (blen < clen) choice = b;                else choice = c;            }                        choice.x += choice.y * 0.5;            choice.y *= 0.866025404;            choice *= scale / texSize;            gl_FragColor = texture2D(texture, choice + center / texSize);        }    ");
            simpleShader.call(this, gl.hexagonalPixelate, {center: [centerX, centerY], scale: scale, texSize: [this.width, this.height]});
            return this
        }

        function ink(strength) {
            gl.ink = gl.ink || new Shader(null, "        uniform sampler2D texture;        uniform float strength;        uniform vec2 texSize;        varying vec2 texCoord;        void main() {            vec2 dx = vec2(1.0 / texSize.x, 0.0);            vec2 dy = vec2(0.0, 1.0 / texSize.y);            vec4 color = texture2D(texture, texCoord);            float bigTotal = 0.0;            float smallTotal = 0.0;            vec3 bigAverage = vec3(0.0);            vec3 smallAverage = vec3(0.0);            for (float x = -2.0; x <= 2.0; x += 1.0) {                for (float y = -2.0; y <= 2.0; y += 1.0) {                    vec3 sample = texture2D(texture, texCoord + dx * x + dy * y).rgb;                    bigAverage += sample;                    bigTotal += 1.0;                    if (abs(x) + abs(y) < 2.0) {                        smallAverage += sample;                        smallTotal += 1.0;                    }                }            }            vec3 edge = max(vec3(0.0), bigAverage / bigTotal - smallAverage / smallTotal);            gl_FragColor = vec4(color.rgb - dot(edge, edge) * strength * 100000.0, color.a);        }    ");
            simpleShader.call(this, gl.ink, {strength: strength * strength * strength * strength * strength, texSize: [this.width, this.height]});
            return this
        }

        function bulgePinch(centerX, centerY, radius, strength) {
            gl.bulgePinch = gl.bulgePinch || warpShader("        uniform float radius;        uniform float strength;        uniform vec2 center;    ", "        coord -= center;        float distance = length(coord);        if (distance < radius) {            float percent = distance / radius;            if (strength > 0.0) {                coord *= mix(1.0, smoothstep(0.0, radius / distance, percent), strength * 0.75);            } else {                coord *= mix(1.0, pow(percent, 1.0 + strength * 0.75) * radius / distance, 1.0 - percent);            }        }        coord += center;    ");
            simpleShader.call(this, gl.bulgePinch, {radius: radius, strength: clamp(-1, strength, 1), center: [centerX, centerY], texSize: [this.width, this.height]});
            return this
        }

        function matrixWarp(matrix, inverse, useTextureSpace) {
            gl.matrixWarp = gl.matrixWarp || warpShader("        uniform mat3 matrix;        uniform bool useTextureSpace;    ", "        if (useTextureSpace) coord = coord / texSize * 2.0 - 1.0;        vec3 warp = matrix * vec3(coord, 1.0);        coord = warp.xy / warp.z;        if (useTextureSpace) coord = (coord * 0.5 + 0.5) * texSize;    ");
            matrix = Array.prototype.concat.apply([], matrix);
            if (matrix.length == 4) {
                matrix = [matrix[0], matrix[1], 0, matrix[2], matrix[3], 0, 0, 0, 1]
            } else {
                if (matrix.length != 9) {
                    throw"can only warp with 2x2 or 3x3 matrix"
                }
            }
            simpleShader.call(this, gl.matrixWarp, {matrix: inverse ? getInverse(matrix) : matrix, texSize: [this.width, this.height], useTextureSpace: useTextureSpace | 0});
            return this
        }

        function perspective(before, after) {
            var a = getSquareToQuad.apply(null, after);
            var b = getSquareToQuad.apply(null, before);
            var c = multiply(getInverse(a), b);
            return this.matrixWarp(c)
        }

        function swirl(centerX, centerY, radius, angle) {
            gl.swirl = gl.swirl || warpShader("        uniform float radius;        uniform float angle;        uniform vec2 center;    ", "        coord -= center;        float distance = length(coord);        if (distance < radius) {            float percent = (radius - distance) / radius;            float theta = percent * percent * angle;            float s = sin(theta);            float c = cos(theta);            coord = vec2(                coord.x * c - coord.y * s,                coord.x * s + coord.y * c            );        }        coord += center;    ");
            simpleShader.call(this, gl.swirl, {radius: radius, center: [centerX, centerY], angle: angle, texSize: [this.width, this.height]});
            return this
        }

        return exports
    })();
    imagelib.drawing = {};
    imagelib.drawing.context = function (size) {
        var canvas = document.createElement("canvas");
        canvas.width = size.w;
        canvas.height = size.h;
        canvas.style.setProperty("image-rendering", "optimizeQuality", null);
        return canvas.getContext("2d")
    };
    imagelib.drawing.copy = function (dstCtx, src, size) {
        dstCtx.drawImage(src.canvas || src, 0, 0, size.w, size.h)
    };
    imagelib.drawing.clear = function (ctx, size) {
        ctx.clearRect(0, 0, size.w, size.h)
    };
    imagelib.drawing.drawCenterInside = function (dstCtx, src, dstRect, srcRect) {
        if (srcRect.w / srcRect.h > dstRect.w / dstRect.h) {
            var h = srcRect.h * dstRect.w / srcRect.w;
            imagelib.drawing.drawImageScaled(dstCtx, src, srcRect.x, srcRect.y, srcRect.w, srcRect.h, dstRect.x, dstRect.y + (dstRect.h - h) / 2, dstRect.w, h)
        } else {
            var w = srcRect.w * dstRect.h / srcRect.h;
            imagelib.drawing.drawImageScaled(dstCtx, src, srcRect.x, srcRect.y, srcRect.w, srcRect.h, dstRect.x + (dstRect.w - w) / 2, dstRect.y, w, dstRect.h)
        }
    };
    imagelib.drawing.drawCenterCrop = function (dstCtx, src, dstRect, srcRect) {
        if (srcRect.w / srcRect.h > dstRect.w / dstRect.h) {
            var w = srcRect.h * dstRect.w / dstRect.h;
            imagelib.drawing.drawImageScaled(dstCtx, src, srcRect.x + (srcRect.w - w) / 2, srcRect.y, w, srcRect.h, dstRect.x, dstRect.y, dstRect.w, dstRect.h)
        } else {
            var h = srcRect.w * dstRect.h / dstRect.w;
            imagelib.drawing.drawImageScaled(dstCtx, src, srcRect.x, srcRect.y + (srcRect.h - h) / 2, srcRect.w, h, dstRect.x, dstRect.y, dstRect.w, dstRect.h)
        }
    };
    imagelib.drawing.drawImageScaled = function (dstCtx, src, sx, sy, sw, sh, dx, dy, dw, dh) {
        if ((dw < sw / 2 && dh < sh / 2) && imagelib.ALLOW_MANUAL_RESCALE) {
            sx = Math.floor(sx);
            sy = Math.floor(sy);
            sw = Math.ceil(sw);
            sh = Math.ceil(sh);
            dx = Math.floor(dx);
            dy = Math.floor(dy);
            dw = Math.ceil(dw);
            dh = Math.ceil(dh);
            var tmpCtx = imagelib.drawing.context({w: sw, h: sh});
            tmpCtx.drawImage(src.canvas || src, -sx, -sy);
            var srcData = tmpCtx.getImageData(0, 0, sw, sh);
            var outCtx = imagelib.drawing.context({w: dw, h: dh});
            var outData = outCtx.createImageData(dw, dh);
            var tr, tg, tb, ta;
            var numOpaquePixels;
            var numPixels;
            for (var y = 0; y < dh; y++) {
                for (var x = 0; x < dw; x++) {
                    tr = tg = tb = ta = 0;
                    numOpaquePixels = numPixels = 0;
                    for (var j = Math.floor(y * sh / dh); j < (y + 1) * sh / dh; j++) {
                        for (var i = Math.floor(x * sw / dw); i < (x + 1) * sw / dw; i++) {
                            ++numPixels;
                            ta += srcData.data[(j * sw + i) * 4 + 3];
                            if (srcData.data[(j * sw + i) * 4 + 3] == 0) {
                                continue
                            }
                            ++numOpaquePixels;
                            tr += srcData.data[(j * sw + i) * 4 + 0];
                            tg += srcData.data[(j * sw + i) * 4 + 1];
                            tb += srcData.data[(j * sw + i) * 4 + 2]
                        }
                    }
                    outData.data[(y * dw + x) * 4 + 0] = tr / numOpaquePixels;
                    outData.data[(y * dw + x) * 4 + 1] = tg / numOpaquePixels;
                    outData.data[(y * dw + x) * 4 + 2] = tb / numOpaquePixels;
                    outData.data[(y * dw + x) * 4 + 3] = ta / numPixels
                }
            }
            outCtx.putImageData(outData, 0, 0);
            dstCtx.drawImage(outCtx.canvas, dx, dy)
        } else {
            dstCtx.drawImage(src.canvas || src, sx, sy, sw, sh, dx, dy, dw, dh)
        }
    };
    imagelib.drawing.trimRectWorkerJS_ = ["self['onmessage'] = function(event) {                                       ", "  var l = event.data.size.w, t = event.data.size.h, r = 0, b = 0;           ", "                                                                            ", "  var alpha;                                                                ", "  for (var y = 0; y < event.data.size.h; y++) {                             ", "    for (var x = 0; x < event.data.size.w; x++) {                           ", "      alpha = event.data.imageData.data[                                    ", "          ((y * event.data.size.w + x) << 2) + 3];                          ", "      if (alpha >= event.data.minAlpha) {                                   ", "        l = Math.min(x, l);                                                 ", "        t = Math.min(y, t);                                                 ", "        r = Math.max(x, r);                                                 ", "        b = Math.max(y, b);                                                 ", "      }                                                                     ", "    }                                                                       ", "  }                                                                         ", "                                                                            ", "  if (l > r) {                                                              ", "    // no pixels, couldn't trim                                             ", "    postMessage({ x: 0, y: 0, w: event.data.size.w, h: event.data.size.h });", "    return;                                                                 ", "  }                                                                         ", "                                                                            ", "  postMessage({ x: l, y: t, w: r - l + 1, h: b - t + 1 });                  ", "};                                                                          ", ""].join("\n");
    imagelib.drawing.getTrimRect = function (ctx, size, minAlpha, callback) {
        callback = callback || function () {
        };
        if (!ctx.canvas) {
            var src = ctx;
            ctx = imagelib.drawing.context(size);
            imagelib.drawing.copy(ctx, src, size)
        }
        if (minAlpha == 0) {
            callback({x: 0, y: 0, w: size.w, h: size.h})
        }
        minAlpha = minAlpha || 1;
        var worker = imagelib.util.runWorkerJs(imagelib.drawing.trimRectWorkerJS_, {imageData: ctx.getImageData(0, 0, size.w, size.h), size: size, minAlpha: minAlpha}, callback);
        return worker
    };
    imagelib.drawing.getCenterOfMass = function (ctx, size, minAlpha, callback) {
        callback = callback || function () {
        };
        if (!ctx.canvas) {
            var src = ctx;
            ctx = imagelib.drawing.context(size);
            imagelib.drawing.copy(ctx, src, size)
        }
        if (minAlpha == 0) {
            callback({x: size.w / 2, y: size.h / 2})
        }
        minAlpha = minAlpha || 1;
        var l = size.w, t = size.h, r = 0, b = 0;
        var imageData = ctx.getImageData(0, 0, size.w, size.h);
        var sumX = 0;
        var sumY = 0;
        var n = 0;
        var alpha;
        for (var y = 0; y < size.h; y++) {
            for (var x = 0; x < size.w; x++) {
                alpha = imageData.data[((y * size.w + x) << 2) + 3];
                if (alpha >= minAlpha) {
                    sumX += x;
                    sumY += y;
                    ++n
                }
            }
        }
        if (n <= 0) {
            callback({x: size.w / 2, h: size.h / 2})
        }
        callback({x: Math.round(sumX / n), y: Math.round(sumY / n)})
    };
    imagelib.drawing.copyAsAlpha = function (dstCtx, src, size, onColor, offColor) {
        onColor = onColor || "#fff";
        offColor = offColor || "#000";
        dstCtx.save();
        dstCtx.clearRect(0, 0, size.w, size.h);
        dstCtx.globalCompositeOperation = "source-over";
        imagelib.drawing.copy(dstCtx, src, size);
        dstCtx.globalCompositeOperation = "source-atop";
        dstCtx.fillStyle = onColor;
        dstCtx.fillRect(0, 0, size.w, size.h);
        dstCtx.globalCompositeOperation = "destination-atop";
        dstCtx.fillStyle = offColor;
        dstCtx.fillRect(0, 0, size.w, size.h);
        dstCtx.restore()
    };
    imagelib.drawing.makeAlphaMask = function (ctx, size, fillColor) {
        var src = ctx.getImageData(0, 0, size.w, size.h);
        var dst = ctx.createImageData(size.w, size.h);
        var srcData = src.data;
        var dstData = dst.data;
        var i, g;
        for (var y = 0; y < size.h; y++) {
            for (var x = 0; x < size.w; x++) {
                i = (y * size.w + x) << 2;
                g = 0.3 * srcData[i] + 0.59 * srcData[i + 1] + 0.11 * srcData[i + 2];
                dstData[i] = dstData[i + 1] = dstData[i + 2] = 255;
                dstData[i + 3] = g
            }
        }
        ctx.putImageData(dst, 0, 0);
        if (fillColor) {
            ctx.save();
            ctx.globalCompositeOperation = "source-atop";
            ctx.fillStyle = fillColor;
            ctx.fillRect(0, 0, size.w, size.h);
            ctx.restore()
        }
    };
    imagelib.drawing.applyFilter = function (filter, ctx, size) {
        var src = ctx.getImageData(0, 0, size.w, size.h);
        var dst = ctx.createImageData(size.w, size.h);
        filter.apply(src, dst);
        ctx.putImageData(dst, 0, 0)
    };
    (function () {
        function slowblur_(radius, ctx, size) {
            var rows = Math.ceil(radius);
            var r = rows * 2 + 1;
            var matrix = new Array(r * r);
            var sigma = radius / 3;
            var sigma22 = 2 * sigma * sigma;
            var sqrtPiSigma22 = Math.sqrt(Math.PI * sigma22);
            var radius2 = radius * radius;
            var total = 0;
            var index = 0;
            var distance2;
            for (var y = -rows; y <= rows; y++) {
                for (var x = -rows; x <= rows; x++) {
                    distance2 = 1 * x * x + 1 * y * y;
                    if (distance2 > radius2) {
                        matrix[index] = 0
                    } else {
                        matrix[index] = Math.exp(-distance2 / sigma22) / sqrtPiSigma22
                    }
                    total += matrix[index];
                    index++
                }
            }
            imagelib.drawing.applyFilter(new ConvolutionFilter(matrix, total, 0, true), ctx, size)
        }

        function glfxblur_(radius, ctx, size) {
            var canvas = fx.canvas();
            var texture = canvas.texture(ctx.canvas);
            canvas.draw(texture).triangleBlur(radius).update();
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(canvas, 0, 0)
        }

        imagelib.drawing.blur = function (radius, ctx, size) {
            try {
                if (size.w > 128 || size.h > 128) {
                    glfxblur_(radius, ctx, size)
                } else {
                    slowblur_(radius, ctx, size)
                }
            } catch (e) {
                slowblur_(radius, ctx, size)
            }
        }
    })();
    imagelib.drawing.fx = function (effects, dstCtx, src, size) {
        effects = effects || [];
        var outerEffects = [];
        var innerEffects = [];
        var fillEffects = [];
        for (var i = 0; i < effects.length; i++) {
            if (/^outer/.test(effects[i].effect)) {
                outerEffects.push(effects[i])
            } else {
                if (/^inner/.test(effects[i].effect)) {
                    innerEffects.push(effects[i])
                } else {
                    if (/^fill/.test(effects[i].effect)) {
                        fillEffects.push(effects[i])
                    }
                }
            }
        }
        var padLeft = 0, padTop, padRight, padBottom;
        var paddedSize;
        var tmpCtx, tmpCtx2;
        for (var i = 0; i < outerEffects.length; i++) {
            padLeft = Math.max(padLeft, outerEffects[i].blur || 0)
        }
        padTop = padRight = padBottom = padLeft;
        paddedSize = {w: size.w + padLeft + padRight, h: size.h + padTop + padBottom};
        tmpCtx = imagelib.drawing.context(paddedSize);
        for (var i = 0; i < outerEffects.length; i++) {
            var effect = outerEffects[i];
            dstCtx.save();
            tmpCtx.save();
            switch (effect.effect) {
                case"outer-shadow":
                    imagelib.drawing.clear(tmpCtx, paddedSize);
                    tmpCtx.save();
                    tmpCtx.translate(padLeft, padTop);
                    imagelib.drawing.copyAsAlpha(tmpCtx, src.canvas || src, size);
                    tmpCtx.restore();
                    if (effect.blur) {
                        imagelib.drawing.blur(effect.blur, tmpCtx, paddedSize)
                    }
                    imagelib.drawing.makeAlphaMask(tmpCtx, paddedSize, effect.color || "#000");
                    if (effect.translate) {
                        dstCtx.translate(effect.translate.x || 0, effect.translate.y || 0)
                    }
                    dstCtx.globalAlpha = Math.max(0, Math.min(1, effect.opacity || 1));
                    dstCtx.translate(-padLeft, -padTop);
                    imagelib.drawing.copy(dstCtx, tmpCtx, paddedSize);
                    break
            }
            dstCtx.restore();
            tmpCtx.restore()
        }
        dstCtx.save();
        tmpCtx = imagelib.drawing.context(size);
        imagelib.drawing.clear(tmpCtx, size);
        imagelib.drawing.copy(tmpCtx, src.canvas || src, size);
        var fillOpacity = 1;
        if (fillEffects.length) {
            var effect = fillEffects[0];
            tmpCtx.save();
            tmpCtx.globalCompositeOperation = "source-atop";
            switch (effect.effect) {
                case"fill-color":
                    tmpCtx.fillStyle = effect.color;
                    break;
                case"fill-lineargradient":
                    var gradient = tmpCtx.createLinearGradient(effect.from.x, effect.from.y, effect.to.x, effect.to.y);
                    for (var i = 0; i < effect.colors.length; i++) {
                        gradient.addColorStop(effect.colors[i].offset, effect.colors[i].color)
                    }
                    tmpCtx.fillStyle = gradient;
                    break
            }
            fillOpacity = Math.max(0, Math.min(1, effect.opacity || 1));
            tmpCtx.fillRect(0, 0, size.w, size.h);
            tmpCtx.restore()
        }
        dstCtx.globalAlpha = fillOpacity;
        imagelib.drawing.copy(dstCtx, tmpCtx, size);
        dstCtx.globalAlpha = 1;
        var translate;
        padLeft = padTop = padRight = padBottom = 0;
        for (var i = 0; i < innerEffects.length; i++) {
            translate = effect.translate || {};
            padLeft = Math.max(padLeft, (innerEffects[i].blur || 0) + Math.max(0, translate.x || 0));
            padTop = Math.max(padTop, (innerEffects[i].blur || 0) + Math.max(0, translate.y || 0));
            padRight = Math.max(padRight, (innerEffects[i].blur || 0) + Math.max(0, -translate.x || 0));
            padBottom = Math.max(padBottom, (innerEffects[i].blur || 0) + Math.max(0, -translate.y || 0))
        }
        paddedSize = {w: size.w + padLeft + padRight, h: size.h + padTop + padBottom};
        tmpCtx = imagelib.drawing.context(paddedSize);
        tmpCtx2 = imagelib.drawing.context(paddedSize);
        for (var i = 0; i < innerEffects.length; i++) {
            var effect = innerEffects[i];
            dstCtx.save();
            tmpCtx.save();
            switch (effect.effect) {
                case"inner-shadow":
                    imagelib.drawing.clear(tmpCtx, paddedSize);
                    tmpCtx.save();
                    tmpCtx.translate(padLeft, padTop);
                    imagelib.drawing.copyAsAlpha(tmpCtx, src.canvas || src, size, "#fff", "#000");
                    tmpCtx.restore();
                    tmpCtx2.save();
                    tmpCtx2.translate(padLeft, padTop);
                    imagelib.drawing.copyAsAlpha(tmpCtx2, src.canvas || src, size);
                    tmpCtx2.restore();
                    if (effect.blur) {
                        imagelib.drawing.blur(effect.blur, tmpCtx2, paddedSize)
                    }
                    imagelib.drawing.makeAlphaMask(tmpCtx2, paddedSize, "#000");
                    if (effect.translate) {
                        tmpCtx.translate(effect.translate.x || 0, effect.translate.y || 0)
                    }
                    tmpCtx.globalCompositeOperation = "source-over";
                    imagelib.drawing.copy(tmpCtx, tmpCtx2, paddedSize);
                    imagelib.drawing.makeAlphaMask(tmpCtx, paddedSize, effect.color);
                    dstCtx.globalAlpha = Math.max(0, Math.min(1, effect.opacity || 1));
                    dstCtx.translate(-padLeft, -padTop);
                    imagelib.drawing.copy(dstCtx, tmpCtx, paddedSize);
                    break
            }
            tmpCtx.restore();
            dstCtx.restore()
        }
        dstCtx.restore()
    };
    imagelib.loadImageResources = function (images, callback) {
        var imageResources = {};
        var checkForCompletion = function () {
            for (var id in images) {
                if (!(id in imageResources)) {
                    return
                }
            }
            (callback || function () {
            })(imageResources);
            callback = null
        };
        for (var id in images) {
            var img = document.createElement("img");
            img.src = images[id];
            (function (img, id) {
                img.onload = function () {
                    imageResources[id] = img;
                    checkForCompletion()
                };
                img.onerror = function () {
                    imageResources[id] = null;
                    checkForCompletion()
                }
            })(img, id)
        }
    };
    imagelib.loadFromUri = function (uri, callback) {
        callback = callback || function () {
        };
        var img = document.createElement("img");
        img.src = uri;
        img.onload = function () {
            callback(img)
        };
        img.onerror = function () {
            callback(null)
        }
    };
    imagelib.toDataUri = function (img) {
        var canvas = document.createElement("canvas");
        canvas.width = img.naturalWidth;
        canvas.height = img.naturalHeight;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);
        return canvas.toDataURL()
    };
    imagelib.util = {};
    imagelib.util.runWorkerJs = function (js, params, callback) {
        var URL = window.URL || window.webkitURL || window.mozURL;
        var Worker = window.Worker;
        if (URL && Worker && imagelib.util.hasBlobConstructor()) {
            var bb = new Blob([js], {type: "text/javascript"});
            var worker = new Worker(URL.createObjectURL(bb));
            worker.onmessage = function (event) {
                callback(event.data)
            };
            worker.postMessage(params);
            return worker
        } else {
            (function () {
                var __DUMMY_OBJECT__ = {};
                var postMessage = function (result) {
                    callback(result)
                };
                eval("var self=__DUMMY_OBJECT__;\n" + js);
                __DUMMY_OBJECT__.onmessage({data: params})
            })();
            return{terminate: function () {
            }}
        }
    };
    imagelib.util.hasBlobConstructor = function () {
        try {
            return !!new Blob()
        } catch (e) {
            return false
        }
    };
    imagelib.util.adler32 = function (arr) {
        arr = arr || [];
        var adler = new imagelib.util.Adler32();
        for (var i = 0; i < arr.length; i++) {
            adler.addNext(arr[i])
        }
        return adler.compute()
    };
    imagelib.util.Adler32 = function () {
        this.reset()
    };
    imagelib.util.Adler32._MOD_ADLER = 65521;
    imagelib.util.Adler32.prototype.reset = function () {
        this._a = 1;
        this._b = 0;
        this._index = 0
    };
    imagelib.util.Adler32.prototype.addNext = function (value) {
        this._a = (this._a + value) % imagelib.util.Adler32._MOD_ADLER;
        this._b = (this._b + this._a) % imagelib.util.Adler32._MOD_ADLER
    };
    imagelib.util.Adler32.prototype.compute = function () {
        return(this._b << 16) | this._a
    };
    imagelib.util.Summer = imagelib.util.Adler32;
    imagelib.util.Summer.prototype = imagelib.util.Adler32.prototype;
    window.imagelib = imagelib
})();
(function () {
    var b = {};
    b.checkBrowser = function () {
        var c = navigator.userAgent.match(/Chrome\/(\d+)/);
        var e = false;
        if (c) {
            var d = parseInt(c[1], 10);
            if (d >= 6) {
                e = true
            }
        }
        if (!e) {
            $("<div>").addClass("browser-unsupported-note ui-state-highlight").attr("title", "Your browser is not supported.").append($('<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;">')).append($("<p>").html('Currently only <a href="http://www.google.com/chrome">Google Chrome</a> is recommended and supported. Your mileage may vary with other browsers.')).prependTo("body")
        }
    };
    b.forms = {};
    b.forms.Form = Base.extend({constructor: function (e, d) {
        this.id_ = e;
        this.params_ = d;
        this.fields_ = d.fields;
        this.pauseNotify_ = false;
        for (var c = 0; c < this.fields_.length; c++) {
            this.fields_[c].setForm_(this)
        }
        this.onChange = this.params_.onChange || function () {
        }
    }, createUI: function (c) {
        for (var d = 0; d < this.fields_.length; d++) {
            var e = this.fields_[d];
            e.createUI(c)
        }
    }, notifyChanged_: function (c) {
        if (this.pauseNotify_) {
            return
        }
        this.onChange(c)
    }, getValues: function () {
        var c = {};
        for (var d = 0; d < this.fields_.length; d++) {
            var e = this.fields_[d];
            c[e.id_] = e.getValue()
        }
        return c
    }, getValuesSerialized: function () {
        var c = {};
        for (var d = 0; d < this.fields_.length; d++) {
            var f = this.fields_[d];
            var e = f.serializeValue ? f.serializeValue() : undefined;
            if (e !== undefined) {
                c[f.id_] = f.serializeValue()
            }
        }
        return c
    }, setValuesSerialized: function (d) {
        this.pauseNotify_ = true;
        for (var c = 0; c < this.fields_.length; c++) {
            var e = this.fields_[c];
            if (e.id_ in d && e.deserializeValue) {
                e.deserializeValue(d[e.id_])
            }
        }
        this.pauseNotify_ = false;
        this.notifyChanged_(null)
    }});
    b.forms.Field = Base.extend({constructor: function (d, c) {
        this.id_ = d;
        this.params_ = c
    }, setForm_: function (c) {
        this.form_ = c
    }, getLongId: function () {
        return this.form_.id_ + "-" + this.id_
    }, getHtmlId: function () {
        return"_frm-" + this.getLongId()
    }, createUI: function (c) {
        c = $(c);
        this.baseEl_ = $("<div>").addClass("form-field-outer").append($("<label>").attr("for", this.getHtmlId()).text(this.params_.title).append($("<div>").addClass("form-field-help-text").css("display", this.params_.helpText ? "" : "none").html(this.params_.helpText))).append($("<div>").addClass("form-field-container")).appendTo(c);
        return this.baseEl_
    }, setEnabled: function (c) {
        if (this.baseEl_) {
            if (c) {
                this.baseEl_.removeAttr("disabled")
            } else {
                this.baseEl_.attr("disabled", "disabled")
            }
        }
    }});
    b.forms.Separator = b.forms.Field.extend({createUI: function (c) {
        var fc = $('.form-field-container', this.base(c));
        var me = this;
        this.el_ = $('<div class="form-field-separator">&nbsp;</div>').appendTo(fc)
    }, getValue: function () {
        return '1';
    }, setValue: function (val, pauseUi) {
    }, serializeValue: function () {
        return '1';
    }, deserializeValue: function (s) {
    }});
    b.forms.TextField = b.forms.Field.extend({createUI: function (c) {
        var e = $(".form-field-container", this.base(c));
        var d = this;
        this.el_ = $("<input>").attr("type", "text").addClass("form-text").val(this.getValue()).bind("change",function () {
            d.setValue($(this).val(), true)
        }).bind("keydown change",function () {
            var g = this;
            var f = d.getValue();
            window.setTimeout(function () {
                var h = $(g).val();
                if (f != h) {
                    d.setValue(h, true)
                }
            }, 0)
        }).appendTo(e)
    }, getValue: function () {
        var c = this.value_;
        if (typeof c != "string") {
            c = this.params_.defaultValue || ""
        }
        return c
    }, setValue: function (d, c) {
        this.value_ = d;
        if (!c) {
            $(this.el_).val(d)
        }
        this.form_.notifyChanged_(this)
    }, serializeValue: function () {
        return this.getValue()
    }, deserializeValue: function (c) {
        this.setValue(c)
    }});
    b.forms.AutocompleteTextField = b.forms.Field.extend({createUI: function (c) {
        var g = $(".form-field-container", this.base(c));
        var f = this;
        var e = this.getHtmlId() + "-datalist";
        this.el_ = $("<input>").attr("type", "text").addClass("form-text").attr("list", e).val(this.getValue()).bind("keydown change",function () {
            var h = this;
            window.setTimeout(function () {
                f.setValue($(h).val(), true)
            }, 0)
        }).appendTo(g);
        this.datalistEl_ = $("<datalist>").attr("id", e).appendTo(g);
        this.params_.items = this.params_.items || [];
        for (var d = 0; d < this.params_.items.length; d++) {
            this.datalistEl_.append($("<option>").attr("value", this.params_.items[d]))
        }
    }, getValue: function () {
        var c = this.value_;
        if (typeof c != "string") {
            c = this.params_.defaultValue || ""
        }
        return c
    }, setValue: function (d, c) {
        this.value_ = d;
        if (!c) {
            $(this.el_).val(d)
        }
        this.form_.notifyChanged_(this)
    }, serializeValue: function () {
        return this.getValue()
    }, deserializeValue: function (c) {
        this.setValue(c)
    }});
    b.forms.ColorField = b.forms.Field.extend({createUI: function (c) {
        var e = $(".form-field-container", this.base(c));
        var d = this;
        this.el_ = $("<input>").addClass("form-color").attr("type", "text").attr("id", this.getHtmlId()).css("background-color", this.getValue().color).appendTo(e);
        this.el_.spectrum({color: this.getValue().color, showInput: true, showPalette: true, palette: [
            ["#fff", "#000"],
            ["#33b5e5", "#09c"],
            ["#a6c", "#93c"],
            ["#9c0", "#690"],
            ["#fb3", "#f80"],
            ["#f44", "#c00"]
        ], localStorageKey: "recentcolors", showInitial: true, showButtons: false, change: function (f) {
            d.setValue({color: f.toHexString()}, true)
        }});
        if (this.params_.alpha) {
            this.alphaEl_ = $("<input>").attr("type", "range").attr("min", 0).attr("max", 100).val(this.getValue().alpha).addClass("form-range").change(function () {
                d.setValue({alpha: Number(d.alphaEl_.val())}, true)
            }).appendTo(e);
            this.alphaTextEl_ = $("<div>").addClass("form-range-text").text(this.getValue().alpha + "%").appendTo(e)
        }
    }, getValue: function () {
        var c = this.value_ || this.params_.defaultValue || "#000000";
        if (/^([0-9a-f]{6}|[0-9a-f]{3})$/i.test(c)) {
            c = "#" + c
        }
        var d = this.alpha_;
        if (typeof d != "number") {
            d = this.params_.defaultAlpha;
            if (typeof d != "number") {
                d = 100
            }
        }
        return{color: c, alpha: d}
    }, setValue: function (e, d) {
        e = e || {};
        if ("color" in e) {
            this.value_ = e.color
        }
        if ("alpha" in e) {
            this.alpha_ = e.alpha
        }
        var c = this.getValue();
        this.el_.css("background-color", c.color);
        if (!d) {
            $(this.el_).spectrum("set", c.color);
            if (this.alphaEl_) {
                this.alphaEl_.val(c.alpha)
            }
        }
        if (this.alphaTextEl_) {
            this.alphaTextEl_.text(c.alpha + "%")
        }
        this.form_.notifyChanged_(this)
    }, serializeValue: function () {
        var c = this.getValue();
        return c.color.replace(/^#/, "") + "," + c.alpha
    }, deserializeValue: function (d) {
        var e = {};
        var c = d.split(",", 2);
        if (c.length >= 1) {
            e.color = c[0]
        }
        if (c.length >= 2) {
            e.alpha = parseInt(c[1], 10)
        }
        this.setValue(e)
    }});
    b.forms.EnumField = b.forms.Field.extend({createUI: function (c) {
        var g = $(".form-field-container", this.base(c));
        var f = this;
        if (this.params_.buttons) {
            this.el_ = $("<div>").attr("id", this.getHtmlId()).addClass("form-field-buttonset").appendTo(g);
            for (var d = 0; d < this.params_.options.length; d++) {
                var e = this.params_.options[d];
                $("<input>").attr({type: "radio", name: this.getHtmlId(), id: this.getHtmlId() + "-" + e.id, value: e.id}).change(function () {
                    f.setValueInternal_($(this).val(), true)
                }).appendTo(this.el_);
                $("<label>").attr("for", this.getHtmlId() + "-" + e.id).html(e.title).appendTo(this.el_)
            }
            this.setValueInternal_(this.getValue())
        } else {
            this.el_ = $("<select>").attr("id", this.getHtmlId()).change(function () {
                f.setValueInternal_($(this).val(), true)
            }).appendTo(g);
            for (var d = 0; d < this.params_.options.length; d++) {
                var e = this.params_.options[d];
                $("<option>").attr("value", e.id).text(e.title).appendTo(this.el_)
            }
            this.el_.combobox({selected: function (h, i) {
                f.setValueInternal_(i.item.value, true);
                f.form_.notifyChanged_(f)
            }});
            this.setValueInternal_(this.getValue())
        }
    }, getValue: function () {
        var c = this.value_;
        if (c === undefined) {
            c = this.params_.defaultValue || this.params_.options[0].id
        }
        return c
    }, setValue: function (d, c) {
        this.setValueInternal_(d, c)
    }, setValueInternal_: function (d, c) {
        this.value_ = d;
        if (!c) {
            if (this.params_.buttons) {
                $("input", this.el_).each(function (e, f) {
                    $(f).attr("checked", $(f).val() == d)
                })
            } else {
                this.el_.val(d)
            }
        }
        this.form_.notifyChanged_(this)
    }, serializeValue: function () {
        return this.getValue()
    }, deserializeValue: function (c) {
        this.setValue(c)
    }});
    b.forms.BooleanField = b.forms.EnumField.extend({constructor: function (d, c) {
        c.options = [
            {id: "1", title: c.onText || "Yes"},
            {id: "0", title: c.offText || "No"}
        ];
        c.defaultValue = c.defaultValue ? "1" : "0";
        c.buttons = true;
        this.base(d, c)
    }, getValue: function () {
        return this.base() == "1"
    }, setValue: function (d, c) {
        this.base(d ? "1" : "0", c)
    }, serializeValue: function () {
        return this.getValue() ? "1" : "0"
    }, deserializeValue: function (c) {
        this.setValue(c == "1")
    }});
    b.forms.RangeField = b.forms.Field.extend({createUI: function (c) {
        var e = $(".form-field-container", this.base(c));
        var d = this;
        this.el_ = $("<input>").attr("type", "range").attr("min", this.params_.min || 0).attr("max", this.params_.max || 100).attr("step", this.params_.step || 1).addClass("form-range").change(function () {
            d.setValue(Number(d.el_.val()) || 0, true)
        }).val(this.getValue()).appendTo(e);
        if (this.params_.textFn || this.params_.showText) {
            this.params_.textFn = this.params_.textFn || function (f) {
                return f
            };
            this.textEl_ = $("<div>").addClass("form-range-text").text(this.params_.textFn(this.getValue())).appendTo(e)
        }
    }, getValue: function () {
        var c = this.value_;
        if (typeof c != "number") {
            c = this.params_.defaultValue;
            if (typeof c != "number") {
                c = 0
            }
        }
        return c
    }, setValue: function (d, c) {
        this.value_ = d;
        if (!c) {
            this.el_.val(d)
        }
        if (this.textEl_) {
            this.textEl_.text(this.params_.textFn(d))
        }
        this.form_.notifyChanged_(this)
    }, serializeValue: function () {
        return this.getValue()
    }, deserializeValue: function (c) {
        this.setValue(Number(c))
    }});
    b.hash = {};
    b.hash.boundFormOldOnChange_ = null;
    b.hash.boundForm_ = null;
    b.hash.currentParams_ = {};
    b.hash.currentHash_ = null;
    b.hash.bindFormToDocumentHash = function (d) {
        if (!b.hash.boundForm_) {
            var e = function () {
                var f = b.hash.paramsToHash(b.hash.hashToParams((document.location.href.match(/#.*/) || [""])[0]));
                if (f != b.hash.currentHash_) {
                    var g = f;
                    var h = b.hash.hashToParams(g);
                    b.hash.onHashParamsChanged_(h);
                    b.hash.currentParams_ = h;
                    b.hash.currentHash_ = g
                }
                window.setTimeout(e, 100)
            };
            window.setTimeout(e, 0)
        }
        if (b.hash.boundFormOldOnChange_ && b.hash.boundForm_) {
            b.hash.boundForm_.onChange = b.hash.boundFormOldOnChange_
        }
        b.hash.boundFormOldOnChange_ = d.onChange;
        b.hash.boundForm_ = d;
        var c = null;
        b.hash.boundForm_.onChange = function () {
            if (c) {
                window.clearTimeout(c)
            }
            c = window.setTimeout(function () {
                b.hash.onFormChanged_()
            }, 500);
            (b.hash.boundFormOldOnChange_ || function () {
            }).apply(d, arguments)
        }
    };
    b.hash.onHashParamsChanged_ = function (c) {
        if (b.hash.boundForm_) {
            b.hash.boundForm_.setValuesSerialized(c)
        }
    };
    b.hash.onFormChanged_ = function () {
        if (b.hash.boundForm_) {
            b.hash.currentParams_ = b.hash.boundForm_.getValuesSerialized();
            b.hash.currentHash_ = b.hash.paramsToHash(b.hash.currentParams_);
            document.location.hash = b.hash.currentHash_
        }
    };
    b.hash.hashToParams = function (l) {
        var e = {};
        l = l.replace(/^[?#]/, "");
        var c = l.split("&");
        for (var m = 0; m < c.length; m++) {
            var g = c[m].split("=", 2);
            var p = g[0] ? decodeURIComponent(g[0]) : g[0];
            var d = g[1] ? decodeURIComponent(g[1]) : g[1];
            var n = p.split(".");
            var h = e;
            for (var f = 0; f < n.length - 1; f++) {
                h[n[f]] = h[n[f]] || {};
                h = h[n[f]]
            }
            var o = n[n.length - 1];
            if (o in h) {
                if (h[o] && h[o].splice) {
                    h[o].push(d)
                } else {
                    h[o] = [h[o], d]
                }
            } else {
                h[o] = d
            }
        }
        return e
    };
    b.hash.paramsToHash = function (l, f) {
        var c = [];
        var h = function (i) {
            return encodeURIComponent((f ? f + "." : "") + i)
        };
        var g = function (m, i) {
            if (i === false) {
                i = 0
            }
            if (i === true) {
                i = 1
            }
            c.push(h(m) + "=" + encodeURIComponent(i.toString()))
        };
        for (var e in l) {
            var j = l[e];
            if (j === undefined || j === null) {
                continue
            }
            if (typeof j == "object") {
                if (j.splice && j.length) {
                    for (var d = 0; d < j.length; d++) {
                        g(e, j[d])
                    }
                } else {
                    c.push(b.hash.paramsToHash(j, h(e)))
                }
            } else {
                g(e, j)
            }
        }
        return c.join("&")
    };
    var a = window.canvg && true;
    b.forms.ImageField = b.forms.Field.extend({constructor: function (d, c) {
        this.valueType_ = null;
        this.textParams_ = {};
        this.imageParams_ = {};
        this.spaceFormValues_ = {};
        this.base(d, c)
    }, createUI: function (d) {
        var l = this.base(d);
        var h = $(".form-field-container", l);
        var n = this;
        l.addClass("form-field-drop-target");
        l.get(0).ondragenter = b.forms.ImageField.makeDragenterHandler_(l);
        l.get(0).ondragleave = b.forms.ImageField.makeDragleaveHandler_(l);
        l.get(0).ondragover = b.forms.ImageField.makeDragoverHandler_(l);
        l.get(0).ondrop = b.forms.ImageField.makeDropHandler_(l, function (i) {
            i.stopPropagation();
            i.preventDefault();
            b.forms.ImageField.loadImageFromFileList(i.dataTransfer.files, function (r) {
                if (!r) {
                    return
                }
                n.setValueType_("image");
                n.imageParams_ = r;
                n.valueFilename_ = r.name;
                n.renderValueAndNotifyChanged_()
            })
        });
        this.el_ = $("<div>").attr("id", this.getHtmlId()).addClass("form-field-buttonset").appendTo(h);
        var m;
        if (this.params_.imageOnly) {
            m = ["image", "Select Image"]
        } else {
            m = ["image", "Image", "clipart", "Clipart", "text", "Text"]
        }
        var e = {};
        for (var g = 0; g < m.length / 2; g++) {
            $("<input>").attr({type: "radio", name: this.getHtmlId(), id: this.getHtmlId() + "-" + m[g * 2], value: m[g * 2]}).appendTo(this.el_);
            e[m[g * 2]] = $("<label>").attr("for", this.getHtmlId() + "-" + m[g * 2]).text(m[g * 2 + 1]).appendTo(this.el_)
        }
        this.fileEl_ = $("<input>").addClass("form-image-hidden-file-field").attr({id: this.getHtmlId(), type: "file", accept: "image/*"}).change(function () {
            b.forms.ImageField.loadImageFromFileList(n.fileEl_.get(0).files, function (i) {
                if (!i) {
                    return
                }
                n.setValueType_("image");
                n.imageParams_ = i;
                n.valueFilename_ = i.name;
                n.renderValueAndNotifyChanged_()
            })
        }).appendTo(this.el_);
        e.image.click(function (i) {
            n.fileEl_.trigger("click");
            n.setValueType_(null);
            n.renderValueAndNotifyChanged_();
            i.preventDefault();
            return false
        });
        if (!this.params_.imageOnly) {
            var c = $("<div>").addClass("form-image-type-params form-image-type-params-clipart").hide().appendTo(h);
            var q;
            var j = $("<input>").addClass("form-image-clipart-filter").attr("placeholder", "Find clipart").keydown(function () {
                var i = $(this);
                setTimeout(function () {
                    var r = i.val().toLowerCase().replace(/[^\w]+/g, "");
                    if (!r) {
                        q.find("img").show()
                    } else {
                        q.find("img").each(function () {
                            var s = $(this);
                            s.toggle(s.attr("title").indexOf(r) >= 0)
                        })
                    }
                }, 0)
            }).appendTo(c);
            q = $("<div>").addClass("form-image-clipart-list").addClass("cancel-parent-scroll").appendTo(c);
            for (var g = 0; g < b.forms.ImageField.clipartList_.length; g++) {
                var o = "res/clipart/" + b.forms.ImageField.clipartList_[g];
                $("<img>").addClass("form-image-clipart-item").attr("src", o).attr("title", b.forms.ImageField.clipartList_[g]).click(function (i) {
                    return function () {
                        n.loadClipart_(i)
                    }
                }(o)).appendTo(q)
            }
            var p = $("<div>").addClass("form-image-clipart-attribution").html(["For clipart sources, visit ", '<a href="http://developer.android.com/design/downloads/">', "Android Design: Downloads", "</a>.<br>", "Additional icons can be found at ", '<a href="http://www.androidicons.com">androidicons.com</a>.'].join("")).appendTo(c);
            e.clipart.click(function (i) {
                n.setValueType_("clipart");
                if (b.AUTO_TRIM) {
                    n.spaceFormTrimField_.setValue(false)
                }
                n.renderValueAndNotifyChanged_()
            });
            var f = $("<div>").addClass("form-subform form-image-type-params form-image-type-params-text").hide().appendTo(h);
            this.textForm_ = new b.forms.Form(this.form_.id_ + "-" + this.id_ + "-textform", {onChange: function () {
                var i = n.textForm_.getValues();
                n.textParams_.text = i.text;
                n.textParams_.fontStack = i.font ? i.font : "Roboto, sans-serif";
                n.valueFilename_ = i.text;
                n.tryLoadWebFont_();
                n.renderValueAndNotifyChanged_()
            }, fields: [new b.forms.TextField("text", {title: "Text", }), new b.forms.AutocompleteTextField("font", {title: "Font", items: b.forms.ImageField.fontList_})]});
            this.textForm_.createUI(f);
            e.text.click(function (i) {
                n.setValueType_("text");
                if (b.AUTO_TRIM) {
                    n.spaceFormTrimField_.setValue(true)
                }
                n.renderValueAndNotifyChanged_()
            })
        }
        if (!this.params_.noTrimForm) {
            this.spaceFormValues_ = {};
            this.spaceForm_ = new b.forms.Form(this.form_.id_ + "-" + this.id_ + "-spaceform", {onChange: function () {
                n.spaceFormValues_ = n.spaceForm_.getValues();
                n.renderValueAndNotifyChanged_()
            }, fields: [(this.spaceFormTrimField_ = new b.forms.BooleanField("trim", {title: "Trim", defaultValue: this.params_.defaultValueTrim || false, offText: "Don't Trim", onText: "Trim"})), new b.forms.RangeField("pad", {title: "Padding", defaultValue: 0, min: -0.1, max: 0.5, step: 0.05, textFn: function (i) {
                return(i * 100).toFixed(0) + "%"
            }}), ]});
            this.spaceForm_.createUI($("<div>").addClass("form-subform").appendTo(h));
            this.spaceFormValues_ = this.spaceForm_.getValues()
        } else {
            this.spaceFormValues_ = {}
        }
        if (!this.params_.noPreview) {
            this.imagePreview_ = $("<canvas>").addClass("form-image-preview").hide().appendTo(h.parent())
        }
    }, tryLoadWebFont_: function (e) {
        var f = this.textForm_.getValues()["font"];
        if (this.loadedWebFont_ == f || !f) {
            return
        }
        var d = this;
        if (!e) {
            if (this.tryLoadWebFont_.timeout_) {
                clearTimeout(this.tryLoadWebFont_.timeout_)
            }
            this.tryLoadWebFont_.timeout_ = setTimeout(function () {
                d.tryLoadWebFont_(true)
            }, 500);
            return
        }
        this.loadedWebFont_ = f;
        var c = this.form_.id_ + "-" + this.id_ + "-__webfont-stylesheet__";
        $("#" + c).remove();
        $("<link>").attr("id", c).attr("rel", "stylesheet").attr("href", "http://fonts.googleapis.com/css?family=" + encodeURIComponent(f)).bind("load",function () {
            d.renderValueAndNotifyChanged_();
            window.setTimeout(function () {
                d.renderValueAndNotifyChanged_()
            }, 500)
        }).appendTo("head")
    }, setValueType_: function (c) {
        this.valueType_ = c;
        $("input", this.el_).removeAttr("checked");
        $(".form-image-type-params", this.el_.parent()).hide();
        if (c) {
            $("#" + this.getHtmlId() + "-" + c).attr("checked", true);
            $(".form-image-type-params-" + c, this.el_.parent()).show()
        }
    }, loadClipart_: function (c) {
        var d = a && c.match(/\.svg$/);
        $("img.form-image-clipart-item", this.el_.parent()).removeClass("selected");
        $('img[src="' + c + '"]').addClass("selected");
        this.imageParams_ = {canvgSvgUri: d ? c : null, uri: d ? null : c};
        this.clipartSrc_ = c;
        this.valueFilename_ = c.match(/[^/]+$/)[0];
        this.renderValueAndNotifyChanged_()
    }, clearValue: function () {
        this.valueType_ = null;
        this.valueFilename_ = null;
        this.valueCtx_ = null;
        this.fileEl_.val("");
        if (this.imagePreview_) {
            this.imagePreview_.hide()
        }
    }, getValue: function () {
        return{ctx: this.valueCtx_, type: this.valueType_, name: this.valueFilename_}
    }, renderValueAndNotifyChanged_: function () {
        if (!this.valueType_) {
            this.valueCtx_ = null
        }
        var g = this;
        switch (this.valueType_) {
            case"image":
            case"clipart":
                if (this.imageParams_.canvgSvgText || this.imageParams_.canvgSvgUri) {
                    var e = document.createElement("canvas");
                    var f = {w: 800, h: 800};
                    e.className = "offscreen";
                    e.width = f.w;
                    e.height = f.h;
                    document.body.appendChild(e);
                    canvg(e, this.imageParams_.canvgSvgText || this.imageParams_.canvgSvgUri, {scaleWidth: f.w, scaleHeight: f.h, ignoreMouse: true, ignoreAnimation: true, ignoreDimensions: true, ignoreClear: true});
                    d(e.getContext("2d"), f);
                    document.body.removeChild(e)
                } else {
                    if (this.imageParams_.uri) {
                        imagelib.loadFromUri(this.imageParams_.uri, function (m) {
                            var n = {w: m.naturalWidth, h: m.naturalHeight};
                            var l = imagelib.drawing.context(n);
                            imagelib.drawing.copy(l, m, n);
                            d(l, n)
                        })
                    }
                }
                break;
            case"text":
                var f = {w: 4800, h: 1600};
                var i = f.h * 0.75;
                var c = imagelib.drawing.context(f);
                var h = this.textParams_.text || "";
                h = " " + h + " ";
                c.fillStyle = "#000";
                c.font = "bold " + i + "px/" + f.h + "px " + this.textParams_.fontStack;
                c.textBaseline = "alphabetic";
                c.fillText(h, 0, i);
                f.w = Math.ceil(Math.min(c.measureText(h).width, f.w) || f.w);
                d(c, f);
                break;
            default:
                g.form_.notifyChanged_(g)
        }
        function d(m, l) {
            if (g.spaceFormValues_.trim) {
                if (g.trimWorker_) {
                    g.trimWorker_.terminate()
                }
                g.trimWorker_ = imagelib.drawing.getTrimRect(m, l, 1, function (n) {
                    j(m, l, n)
                })
            } else {
                j(m, l, {x: 0, y: 0, w: l.w, h: l.h})
            }
        }

        function j(p, n, o) {
            var s = g.spaceFormValues_.trim ? 0.001 : 0;
            if (o.x == 0 && o.y == 0 && o.w == n.w && o.h == n.h) {
                s = 0
            }
            var r = Math.round(((g.spaceFormValues_.pad || 0) + s) * Math.min(o.w, o.h));
            var q = {x: r, y: r, w: o.w, h: o.h};
            var m = imagelib.drawing.context({w: o.w + r * 2, h: o.h + r * 2});
            imagelib.drawing.drawCenterInside(m, p, q, o);
            g.valueCtx_ = m;
            if (g.imagePreview_) {
                g.imagePreview_.attr("width", m.canvas.width);
                g.imagePreview_.attr("height", m.canvas.height);
                var l = g.imagePreview_.get(0).getContext("2d");
                l.drawImage(m.canvas, 0, 0);
                g.imagePreview_.show()
            }
            g.form_.notifyChanged_(g)
        }
    }, serializeValue: function () {
        return{type: this.valueType_, space: this.spaceForm_.getValuesSerialized(), clipart: (this.valueType_ == "clipart") ? this.clipartSrc_ : null, text: (this.valueType_ == "text") ? this.textForm_.getValuesSerialized() : null}
    }, deserializeValue: function (c) {
        if (c.type) {
            this.setValueType_(c.type)
        }
        if (c.space) {
            this.spaceForm_.setValuesSerialized(c.space);
            this.spaceFormValues_ = this.spaceForm_.getValues()
        }
        if (c.clipart && this.valueType_ == "clipart") {
            this.loadClipart_(c.clipart)
        }
        if (c.text && this.valueType_ == "text") {
            this.textForm_.setValuesSerialized(c.text);
            this.tryLoadWebFont_()
        }
    }});
    b.forms.ImageField.clipartList_ = ["icons/core_overflow.svg", "icons/action_about.svg", "icons/action_help.svg", "icons/action_search.svg", "icons/action_settings.svg", "icons/alerts_and_states_add_alarm.svg", "icons/alerts_and_states_airplane_mode_off.svg", "icons/alerts_and_states_airplane_mode_on.svg", "icons/alerts_and_states_error.svg", "icons/alerts_and_states_warning.svg", "icons/av_add_to_queue.svg", "icons/av_download.svg", "icons/av_fast_forward.svg", "icons/av_full_screen.svg", "icons/av_make_available_offline.svg", "icons/av_next.svg", "icons/av_pause.svg", "icons/av_pause_over_video.svg", "icons/av_play.svg", "icons/av_play_over_video.svg", "icons/av_previous.svg", "icons/av_repeat.svg", "icons/av_replay.svg", "icons/av_return_from_full_screen.svg", "icons/av_rewind.svg", "icons/av_shuffle.svg", "icons/av_stop.svg", "icons/av_upload.svg", "icons/collections_cloud.svg", "icons/collections_collection.svg", "icons/collections_go_to_today.svg", "icons/collections_labels.svg", "icons/collections_new_label.svg", "icons/collections_sort_by_size.svg", "icons/collections_view_as_grid.svg", "icons/collections_view_as_list.svg", "icons/content_attachment.svg", "icons/content_backspace.svg", "icons/content_copy.svg", "icons/content_cut.svg", "icons/content_discard.svg", "icons/content_edit.svg", "icons/content_email.svg", "icons/content_event.svg", "icons/content_import_export.svg", "icons/content_merge.svg", "icons/content_new.svg", "icons/content_new_attachment.svg", "icons/content_new_email.svg", "icons/content_new_event.svg", "icons/content_new_picture.svg", "icons/content_paste.svg", "icons/content_picture.svg", "icons/content_read.svg", "icons/content_remove.svg", "icons/content_save.svg", "icons/content_select_all.svg", "icons/content_split.svg", "icons/content_undo.svg", "icons/content_unread.svg", "icons/device_access_accounts.svg", "icons/device_access_alarms.svg", "icons/device_access_battery.svg", "icons/device_access_bluetooth.svg", "icons/device_access_bluetooth_connected.svg", "icons/device_access_bluetooth_searching.svg", "icons/device_access_brightness_auto.svg", "icons/device_access_brightness_high.svg", "icons/device_access_brightness_low.svg", "icons/device_access_brightness_medium.svg", "icons/device_access_call.svg", "icons/device_access_camera.svg", "icons/device_access_data_usage.svg", "icons/device_access_dial_pad.svg", "icons/device_access_end_call.svg", "icons/device_access_flash_automatic.svg", "icons/device_access_flash_off.svg", "icons/device_access_flash_on.svg", "icons/device_access_location_found.svg", "icons/device_access_location_off.svg", "icons/device_access_location_searching.svg", "icons/device_access_mic.svg", "icons/device_access_mic_muted.svg", "icons/device_access_network_cell.svg", "icons/device_access_network_wifi.svg", "icons/device_access_new_account.svg", "icons/device_access_not_secure.svg", "icons/device_access_ring_volume.svg", "icons/device_access_screen_locked_to_landscape.svg", "icons/device_access_screen_locked_to_portrait.svg", "icons/device_access_screen_rotation.svg", "icons/device_access_sd_storage.svg", "icons/device_access_secure.svg", "icons/device_access_storage_1.svg", "icons/device_access_switch_camera.svg", "icons/device_access_switch_video.svg", "icons/device_access_time.svg", "icons/device_access_usb.svg", "icons/device_access_video.svg", "icons/device_access_volume_muted.svg", "icons/device_access_volume_on.svg", "icons/hardware_computer.svg", "icons/hardware_dock.svg", "icons/hardware_gamepad.svg", "icons/hardware_headphones.svg", "icons/hardware_headset.svg", "icons/hardware_keyboard.svg", "icons/hardware_mouse.svg", "icons/hardware_phone.svg", "icons/images_crop.svg", "icons/images_rotate_left.svg", "icons/images_rotate_right.svg", "icons/images_slideshow.svg", "icons/location_directions.svg", "icons/location_map.svg", "icons/location_place.svg", "icons/location_web_site.svg", "icons/navigation_accept.svg", "icons/navigation_back.svg", "icons/navigation_cancel.svg", "icons/navigation_collapse.svg", "icons/navigation_expand.svg", "icons/navigation_forward.svg", "icons/navigation_next_item.svg", "icons/navigation_previous_item.svg", "icons/navigation_refresh.svg", "icons/rating_bad.svg", "icons/rating_favorite.svg", "icons/rating_good.svg", "icons/rating_half_important.svg", "icons/rating_important.svg", "icons/rating_not_important.svg", "icons/social_add_group.svg", "icons/social_add_person.svg", "icons/social_cc_bcc.svg", "icons/social_chat.svg", "icons/social_forward.svg", "icons/social_group.svg", "icons/social_person.svg", "icons/social_reply.svg", "icons/social_reply_all.svg", "icons/social_send_now.svg", "icons/social_share.svg"];
    b.forms.ImageField.fontList_ = ["Roboto", "Helvetica", "Arial", "Georgia", "Book Antiqua", "Palatino", "Courier", "Courier New", "Webdings", "Wingdings"];
    b.forms.ImageField.loadImageFromFileList = function (d, h) {
        d = d || [];
        var f = null;
        for (var e = 0; e < d.length; e++) {
            if (b.forms.ImageField.isValidFile_(d[e])) {
                f = d[e];
                break
            }
        }
        if (!f) {
            alert("Please choose a valid image file (PNG, JPG, GIF, SVG, etc.)");
            h(null);
            return
        }
        var g = a && f.type == "image/svg+xml";
        var c = new FileReader();
        c.onload = function (i) {
            h({uri: g ? null : i.target.result, canvgSvgText: g ? i.target.result : null, name: f.name})
        };
        c.onerror = function (i) {
            switch (i.target.error.code) {
                case i.target.error.NOT_FOUND_ERR:
                    alert("File not found!");
                    break;
                case i.target.error.NOT_READABLE_ERR:
                    alert("File is not readable");
                    break;
                case i.target.error.ABORT_ERR:
                    break;
                default:
                    alert("An error occurred reading this file.")
            }
            h(null)
        };
        c.onabort = function (i) {
            alert("File read cancelled");
            h(null)
        };
        if (g) {
            c.readAsText(f)
        } else {
            c.readAsDataURL(f)
        }
    };
    b.forms.ImageField.isValidFile_ = function (c) {
        return !!c.type.toLowerCase().match(/^image\//)
    };
    b.forms.ImageField.makeDropHandler_ = function (d, c) {
        return function (e) {
            $(d).removeClass("drag-hover");
            c(e)
        }
    };
    b.forms.ImageField.makeDragoverHandler_ = function (c) {
        return function (d) {
            c = $(c).get(0);
            if (c._studio_frm_dragtimeout_) {
                window.clearTimeout(c._studio_frm_dragtimeout_);
                c._studio_frm_dragtimeout_ = null
            }
            d.dataTransfer.dropEffect = "link";
            d.preventDefault()
        }
    };
    b.forms.ImageField.makeDragenterHandler_ = function (c) {
        return function (d) {
            c = $(c).get(0);
            if (c._studio_frm_dragtimeout_) {
                window.clearTimeout(c._studio_frm_dragtimeout_);
                c._studio_frm_dragtimeout_ = null
            }
            $(c).addClass("drag-hover");
            d.preventDefault()
        }
    };
    b.forms.ImageField.makeDragleaveHandler_ = function (c) {
        return function (d) {
            c = $(c).get(0);
            if (c._studio_frm_dragtimeout_) {
                window.clearTimeout(c._studio_frm_dragtimeout_)
            }
            c._studio_frm_dragtimeout_ = window.setTimeout(function () {
                $(c).removeClass("drag-hover")
            }, 100)
        }
    };
    $(document).ready(function () {
        $(".cancel-parent-scroll").on("mousewheel DOMMouseScroll", function (c) {
            var d = c.originalEvent.wheelDelta || -c.originalEvent.detail;
            this.scrollTop -= d;
            c.preventDefault()
        })
    });
    b.ui = {};
    b.ui.createImageOutputGroup = function (c) {
        return $("<div>").addClass("out-image-group").addClass(c.dark ? "dark" : "light").append($("<div>").addClass("label").text(c.label)).appendTo(c.container)
    };
    b.ui.createImageOutputSlot = function (c) {
        return $("<div>").addClass("out-image-block").append($("<div>").addClass("label").text(c.label)).append($("<img>").addClass("out-image").attr("id", c.id)).appendTo(c.container)
    };
    b.ui.drawImageGuideRects = function (c, e, f) {
        f = f || [];
        c.save();
        c.globalAlpha = 0.5;
        c.fillStyle = "#fff";
        c.fillRect(0, 0, e.w, e.h);
        c.globalAlpha = 1;
        var g = b.ui.drawImageGuideRects.guideColors_;
        for (var d = 0; d < f.length; d++) {
            c.strokeStyle = g[(d - 1) % g.length];
            c.strokeRect(f[d].x + 0.5, f[d].y + 0.5, f[d].w - 1, f[d].h - 1)
        }
        c.restore()
    };
    b.ui.drawImageGuideRects.guideColors_ = ["#f00"];
    b.ui.setupDragout = function () {
        if (b.ui.setupDragout.completed_) {
            return
        }
        b.ui.setupDragout.completed_ = true;
        $(document).ready(function () {
            document.body.addEventListener("dragstart", function (d) {
                var c = d.target;
                if (c.classList.contains("dragout")) {
                    d.dataTransfer.setData("DownloadURL", c.dataset.downloadurl)
                }
            }, false)
        })
    };
    b.util = {};
    b.util.getMultBaseMdpi = function (c) {
        switch (c) {
            case"xxxhdpi":
                return 4;
            case"xxhdpi":
                return 3;
            case"xhdpi":
                return 2;
            case"hdpi":
                return 1.5;
            case"mdpi":
                return 1;
            case"ldpi":
                return 0.75
        }
        return 1
    };
    b.util.mult = function (c, e) {
        var f = {};
        for (k in c) {
            f[k] = c[k] * e
        }
        return f
    };
    b.util.multRound = function (c, e) {
        var f = {};
        for (k in c) {
            f[k] = Math.round(c[k] * e)
        }
        return f
    };
    b.util.sanitizeResourceName = function (c) {
        return c.toLowerCase().replace(/[\s-\.]/g, "_").replace(/[^\w_]/g, "")
    };
    b.zip = {};
    (function () {
        function d(f, e) {
            var g = ";base64,";
            var h = window.atob(f);
            var m = h.length;
            var l = new Uint8Array(m);
            for (var j = 0; j < m; ++j) {
                l[j] = h.charCodeAt(j)
            }
            if (imagelib.util.hasBlobConstructor()) {
                return new Blob([l], {type: e})
            }
            var n = new BlobBuilder();
            n.append(l.buffer);
            return n.getBlob(e)
        }

        function c(e) {
            if (!e.fileSpecs_.length) {
                return""
            }
            var g = new JSZip();
            for (var f = 0; f < e.fileSpecs_.length; f++) {
                var h = e.fileSpecs_[f];
                if (h.base64data) {
                    g.add(h.name, h.base64data, {base64: true})
                } else {
                    if (h.textData) {
                        g.add(h.name, h.textData)
                    }
                }
            }
            return g.generate()
        }

        window.URL = window.URL || window.webkitURL || window.mozURL;
        window.BlobBuilder = window.BlobBuilder || window.WebKitBlobBuilder || window.MozBlobBuilder;
        b.zip.createDownloadifyZipButton = function (g, f) {
            var e = {fileSpecs_: []};
            var i = $("<a>").addClass("dragout").addClass("form-button").attr("disabled", "disabled").text("Download .ZIP").get(0);
            $(g).replaceWith(i);
            var h = null;

            function j(m) {
                if (i.href) {
                    window.URL.revokeObjectURL(i.href);
                    i.href = null
                }
                if (!m) {
                    $(i).attr("disabled", "disabled");
                    if (h) {
                        window.clearTimeout(h)
                    }
                    h = window.setTimeout(function () {
                        j(true);
                        h = null
                    }, 500);
                    return
                }
                var l = e.zipFilename_ || "output.zip";
                if (!e.fileSpecs_.length) {
                    return
                }
                i.download = l;
                i.href = window.URL.createObjectURL(d(c(e), "application/zip"));
                i.draggable = true;
                i.dataset.downloadurl = ["application/zip", i.download, i.href].join(":");
                $(i).removeAttr("disabled")
            }

            e.setZipFilename = function (l) {
                e.zipFilename_ = l;
                j()
            };
            e.clear = function () {
                e.fileSpecs_ = [];
                j()
            };
            e.add = function (l) {
                e.fileSpecs_.push(l);
                j()
            };
            return e
        };
        b.ui.setupDragout()
    })();
    window.studio = b
})();