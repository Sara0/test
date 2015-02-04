<script>
function count_data(e) {
	cf = getVal("cf"),
	dl_click(e + cf)
}
function dl_click(e) {
	try {
		e == "" && (e = "default_genera_list_refer");
		var t;
		t = escape(document.referrer),
		t == "" && (t = "noref");
		var n;
		n = escape(location.href);
		var r = new Date,
		i = new Image(1, 1);
		i.src = "http://stat.ppstream.com/onclick.php?clt=" + e + "&t=" + r.getTime() + "&ref=" + t + "&url=" + n,
		i.onload = function() {
			return
		}
	} catch(s) {}
}
function dreg_username() {
	var e, t;
	document.all ? e = !0 : e = !1;
	var n = getId("user_name");
	userEmailCheck()
}
function userEmailCheck() {
	regClassObj.isEmail() && regClassObj.check_account()
}
function dreg_pwd() {
	regClassObj.dreg_pwd()
}
function dreg_repwd() {
	regClassObj.dreg_repwd()
}
function dreg_username_cn() {
	regClassObj.dreg_username_cn()
}
function dreg_userid() {
	regClassObj.dreg_userid()
}
function dreg_form_submit_5_cf(e) {
	regClassObj.regSumbitForm(e)
}
var base_url = "/index.php?",
getId = function(e) {
	return "string" == typeof e ? document.getElementById(e) : ""
},
getVal = function(e) {
	return getId(e) ? getId(e).value: ""
},
setVal = function(e, t) {
	getId(e) && (getId(e).value = t)
},
regClass = function() {},
display_right_info = function(e) {
	getId(e).className = "rightInfo",
	getId(e).style.display = "block",
	getId(e).innerHTML = "<em>正确</em>"
};
regClass.prototype = {
	Uninitialized: 0,
	Loading: 1,
	Loaded: 2,
	Interactive: 3,
	Complete: 4,
	initialize: function(e, t) {
		this.url = e,
		this.parameters = "",
		this.xmlhttp = null,
		this.onUninitialized = this.onLoading = this.onLoaded = this.onInteractive = this.onComplete = function() {},
		this.setOptions(t || {});
		if (window.ActiveXObject) {
			var n = ["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"];
			for (var r = 0; r < n.length; r++) var i = new ActiveXObject(n[r])
		} else if (window.XMLHttpRequest) var i = new XMLHttpRequest;
		this.xmlhttp = i
	},
	setOptions: function(e) {
		e.parameters ? this.parameters = e.parameters + "&rand=" + Math.random() : this.parameters = "rand=" + Math.random(),
		this.url += (this.url.indexOf("?") != -1 ? "&": "?") + this.parameters,
		e.onUninitialized && (this.onUninitialized = e.onUninitialized),
		e.onLoading && (this.onLoading = e.onLoading),
		e.onLoaded && (this.onLoaded = e.onLoaded),
		e.onInteractive && (this.onInteractive = e.onInteractive),
		e.onComplete && (this.onComplete = e.onComplete)
	},
	request: function() {
		if (this.xmlhttp) {
			this.xmlhttp.open("GET", this.url, !0);
			var e = this,
			t = this.xmlhttp;
			this.xmlhttp.onreadystatechange = function() {
				t.readyState == e.Uninitialized ? e.onUninitialized() : t.readyState == e.Loading ? e.onLoading() : t.readyState == e.Loaded ? e.onLoaded() : t.readyState == e.Interactive ? e.onInteractive() : t.readyState == e.Complete && (t.status == 200 ? e.onComplete(t) : e.onComplete())
			},
			this.xmlhttp.send(null)
		}
		return this
	},
	ajaxRequest: function(e, t) {
		return this.initialize(e, t),
		this.request()
	},
	isEmail: function isEmail(e) {
		if (getVal("user_name") == "") return this.display_error_info("dreg_name", "<em>用户名不能为空</em>"),
		!1;
		if (getVal("user_name").length > 50) return this.display_error_info("dreg_name", "<em>长度限制50个字符</em>"),
		!1;
		var t = /^([a-z0-9]*[\-_]?[a-z0-9_\.]+)@([a-z0-9]*[\-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i;
		return t.test(getVal("user_name")) ? !0 : (this.display_error_info("dreg_name", "<em>email格式不正确</em>"), !1)
	},
	dreg_pwd: function() {
		return getVal("user_passwd") == "" ? (this.display_error_info("dreg_pwd", "<em>密码不能为空</em>"), result = !1, !1) : getVal("user_passwd").length < 6 || getVal("user_passwd").length > 16 ? (this.display_error_info("dreg_pwd", "<em>密码(6至16个字符)</em>"), result = !1, !1) : this.checkPass(getVal("user_passwd")) ? (display_right_info("dreg_pwd", "<em>正确</em>"), result = !0, !0) : (this.display_error_info("dreg_pwd", "<em>仅限6-16位数字、字母</em>"), !1)
	},
	dreg_repwd: function() {
		return getVal("re_user_passwd") == "" ? (this.display_error_info("dreg_repwd", "<em>两次密码要一致</em>"), result = !1, !1) : getVal("re_user_passwd").length < 6 || getVal("re_user_passwd").length > 16 ? (this.display_error_info("dreg_repwd", "<em>密码(6至16个字符)</em>"), result = !1, !1) : getVal("re_user_passwd") != getVal("user_passwd") ? (this.display_error_info("dreg_repwd", "<em>两次密码要一致</em>"), result = !1, !1) : (display_right_info("dreg_repwd", "<em>正确</em>"), !0)
	},
	dreg_username_cn: function() {
		return getVal("user_name2") == "" ? (this.display_error_info("dreg_user_name2", "<em>必填，以保障您的用户权益</em>"), result = !1, !1) : this.check_isChinese(getVal("user_name2")) ? getVal("user_name2").length < 2 || getVal("user_name2").length > 20 ? (this.display_error_info("dreg_user_name2", "<em>至少为2-20个字符</em>"), result = !1, !1) : (count_data("dreg_username_cn_true_"), display_right_info("dreg_user_name2", "<em>正确</em>"), !0) : (this.display_error_info("dreg_user_name2", "<em>至少为2-5个汉字</em>"), result = !1, !1)
	},
	dreg_userid: function() {
		var e = this.checkIdcard(getVal("user_id"));
		return getVal("user_id") == "" ? (this.display_error_info("dreg_user_id", "<em>身份证不能为空</em>"), result = !1, !1) : e != "yes" ? (this.display_error_info("dreg_user_id", "<em>" + e + "</em>"), result = !1, !1) : (display_right_info("dreg_user_id", "<em>正确</em>"), !0)
	},
	checkIdcard: function(e) {
		if ( !! this.checkTWIDcard(e)) return "yes";
		var t = new Array("yes", "身份证号码位数不对!", "身份证号码出生日期超出范围或含有非法字符!", "身份证号码校验错误!", "身份证非法!"),
		n = {
			11 : "北京",
			12 : "天津",
			13 : "河北",
			14 : "山西",
			15 : "内蒙古",
			21 : "辽宁",
			22 : "吉林",
			23 : "黑龙江",
			31 : "上海",
			32 : "江苏",
			33 : "浙江",
			34 : "安徽",
			35 : "福建",
			36 : "江西",
			37 : "山东",
			41 : "河南",
			42 : "湖北",
			43 : "湖南",
			44 : "广东",
			45 : "广西",
			46 : "海南",
			50 : "重庆",
			51 : "四川",
			52 : "贵州",
			53 : "云南",
			54 : "西藏",
			61 : "陕西",
			62 : "甘肃",
			63 : "青海",
			64 : "宁夏",
			65 : "新疆",
			71 : "台湾",
			81 : "香港",
			82 : "澳门",
			91 : "国外"
		},
		e,
		r,
		i,
		s,
		o,
		u = new Array;
		u = e.split("");
		if (n[parseInt(e.substr(0, 2))] == null) return t[4];
		switch (e.length) {
		case 15:
			if (e = "111111111111111") {
				return t[3];
				break
			} (parseInt(e.substr(6, 2)) + 1900) % 4 == 0 || (parseInt(e.substr(6, 2)) + 1900) % 100 == 0 && (parseInt(e.substr(6, 2)) + 1900) % 4 == 0 ? ereg = /^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}$/: ereg = /^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}$/;
			return ereg.test(e) ? t[0] : t[2];
			break;
		case 18:
			parseInt(e.substr(6, 4)) % 4 == 0 || parseInt(e.substr(6, 4)) % 100 == 0 && parseInt(e.substr(6, 4)) % 4 == 0 ? ereg = /^[1-9][0-9]{5}19[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}[0-9Xx]$/: ereg = /^[1-9][0-9]{5}19[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}[0-9Xx]$/;
			return ereg.test(e) ? (s = (parseInt(u[0]) + parseInt(u[10])) * 7 + (parseInt(u[1]) + parseInt(u[11])) * 9 + (parseInt(u[2]) + parseInt(u[12])) * 10 + (parseInt(u[3]) + parseInt(u[13])) * 5 + (parseInt(u[4]) + parseInt(u[14])) * 8 + (parseInt(u[5]) + parseInt(u[15])) * 4 + (parseInt(u[6]) + parseInt(u[16])) * 2 + parseInt(u[7]) * 1 + parseInt(u[8]) * 6 + parseInt(u[9]) * 3, r = s % 11, o = "F", i = "10X98765432", o = i.substr(r, 1), lowerM = o.toLowerCase(), o == u[17] || lowerM == u[17] ? t[0] : t[3]) : t[2];
			break;
		default:
			return t[1]
		}
	},
	checkTWIDcard: function(e) {
		area = {
			A: 10,
			B: 11,
			C: 12,
			D: 13,
			E: 14,
			F: 15,
			G: 16,
			H: 17,
			J: 18,
			K: 19,
			L: 20,
			M: 21,
			N: 22,
			P: 23,
			Q: 24,
			R: 25,
			S: 26,
			T: 27,
			U: 28,
			V: 29,
			X: 30,
			Y: 31,
			W: 32,
			Z: 33,
			I: 34,
			O: 35
		},
		areaNum = area[e.charAt(0)];
		if (areaNum == null) return ! 1;
		areaTens = areaNum / 10,
		areaUnits = areaNum % 10,
		y = areaTens + 9 * areaUnits;
		for (i = 1; i < 9; i++) y += (9 - i) * e.charAt(i);
		return y += parseInt(e.charAt(9)),
		y % 10 == 0 ? !0 : !1
	},
	checkPass: function(e) {
		var t = /^[0-9a-zA-Z]{6,16}$/;
		return t.exec(e) ? !0 : !1
	},
	regSumbitForm: function(e) {
		if (!this.isEmail()) return ! 1;
		if (!this.dreg_pwd()) return ! 1;
		if (!this.dreg_repwd()) return ! 1;
		if (!this.checkPass(getVal("user_passwd"))) return ! 1;
		if (e) {
			if (!this.dreg_username_cn()) return ! 1;
			if (!this.dreg_userid()) return ! 1
		}
		var t = encodeURI(getVal("user_name")),
		n = base_url + "m=passport&c=passport&a=regist",
		r = "username=" + t + "&userpasswd=" + getVal("user_passwd") + "&re_user_passwd=" + getVal("re_user_passwd") + "&gameid=" + $("#gameid").val() + "&serverid=" + $("#serverid").val() + "&uid=" + $("#uid").val() + "&preurl=" + $("#preurl").val() + "&ajax=1",
		i = this.ajaxRequest(n, {
			method: "get",
			parameters: r,
			onComplete: this.ajax_reg_showResponse
		})
	},
	ajax_reg_showResponse: function(e) {
		re_value = e.responseText;
		var t = new regClass;
		switch (re_value) {
		case "A00000":
			goDownload("reg");
			break;
		case "no_name":
			t.display_error_info("dreg_name", "<em>用户名为空</em>");
			break;
		case "no_pass":
			t.display_error_info("dreg_pass", "<em>密码为空</em>");
			break;
		case "P00105":
			t.display_error_info("dreg_name", "<em>用户名重名</em>");
			break;
		case "P00104":
			t.display_error_info("dreg_pass", "<em>密码格式错误</em>");
			break;
		default:
			t.display_error_info("dreg_name", "<em>注册失败</em>")
		}
	},
	display_error_info: function(e, t, n) {
		n != undefined ? getId(e).className = n: getId(e).className = "errorInfo",
		getId(e).style.display = "block",
		getId(e).innerHTML = t
	},
	check_account: function() {
		var e = getId("position") ? getVal("position") : "reg",
		t = getId("user_name") ? getVal("user_name") : "";
		if (t) var n = base_url + "m=passport&c=passport&a=check_account",
		r = "email=" + t + "&position=" + e,
		i = this.ajaxRequest(n, {
			method: "get",
			parameters: r,
			onComplete: this.callBackCheckEmail
		});
		else this.display_error_info("dreg_name", "<em>用户名不能为空</em>")
	},
	callBackCheckEmail: function(e) {
		re_value = e.responseText;
		var t = new regClass;
		switch (re_value) {
		case "0":
			display_right_info("dreg_name", "<em>正确</em>");
			break;
		case "1":
			t.display_error_info("dreg_name", "<em>该用户已被注册</em>");
			break;
		case "2":
			t.display_error_info("dreg_name", "<em>缺少参数</em>");
			break;
		case "3":
			t.display_error_info("dreg_name", "<em>email格式不正确</em>");
			break;
		default:
			t.display_error_info("dreg_name", "<em>未知错误</em>")
		}
	},
	check_isChinese: function(e) {
		var t = /^[\u4e00-\u9fa5]{2,5}$/i;
		return t.test(e) ? !0 : !1
	}
};
var regClassObj = new regClass
</script>