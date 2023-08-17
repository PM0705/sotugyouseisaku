window.addEventListener('DOMContentLoaded', () => {

    // 「送信」ボタンの要素を取得
    const submit = document.querySelector('.submit');
    
    // 「送信」ボタンの要素にクリックイベントを設定する
    submit.addEventListener('click', (e) => {
        // デフォルトアクションをキャンセル
        // e.preventDefault();
        //変数にerror_flag
        let error_flag = false;

        // 「名前（姓）」入力欄の空欄チェック
        // フォームの要素を取得
        const family_name = document.querySelector('#family_name');
        // エラーメッセージを表示させる要素を取得
        const errMsgfamily_name = document.querySelector('.err-msg-family_name');
        if(!family_name.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgfamily_name.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgfamily_name.textContent = '↑名前（姓）が未入力です。↑';
            // クラスを追加(フォームの枠線を赤くする)
            family_name.classList.add('input-invalid');
            // 後続の処理を止める
            //エラーが起きたところでerror_flag = true;を入力
            error_flag = true;
            // e.preventDefault();
            // return;
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgfamily_name.textContent ='';
            // クラスを削除
            family_name.classList.remove('input-invalid');
        }
        
        // 「名前（名）」入力欄の空欄チェック
        // フォームの要素を取得
        const last_name = document.querySelector('#last_name');
        // エラーメッセージを表示させる要素を取得
        const errMsglast_name= document.querySelector('.err-msg-last_name');
        if(!last_name.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsglast_name.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsglast_name.textContent = '↑名前（名）が未入力です。↑';
            // クラスを追加(フォームの枠線を赤くする)
            last_name.classList.add('input-invalid');
            // 後続の処理を止める
            error_flag = true;
           
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsglast_name.textContent ='';
            // クラスを削除
            last_name.classList.remove('input-invalid');
        }
        // 「カナ（姓）」入力欄の空欄チェック
        // フォームの要素を取得
        const family_name_kana = document.querySelector('#family_name_kana');
        // エラーメッセージを表示させる要素を取得
        const errMsgfamily_name_kana= document.querySelector('.err-msg-family_name_kana');
        if(!family_name_kana.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgfamily_name_kana.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgfamily_name_kana.textContent = '↑カナ（姓）が未入力です。↑';
            // クラスを追加(フォームの枠線を赤くする)
            family_name_kana.classList.add('input-invalid');
            // 後続の処理を止める
            error_flag = true;
           
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgfamily_name_kana.textContent ='';
            // クラスを削除
            family_name_kana.classList.remove('input-invalid');
        }

        // 「カナ（名）」入力欄の空欄チェック
        // フォームの要素を取得
        const last_name_kana = document.querySelector('#last_name_kana');
        // エラーメッセージを表示させる要素を取得
        const errMsglast_name_kana= document.querySelector('.err-msg-last_name_kana');
        if(!last_name_kana.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsglast_name_kana.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsglast_name_kana.textContent = '↑カナ（名）が未入力です。↑';
            // クラスを追加(フォームの枠線を赤くする)
            last_name_kana.classList.add('input-invalid');
            // 後続の処理を止める
            error_flag = true;
           
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsglast_name_kana.textContent ='';
            // クラスを削除
            last_name_kana.classList.remove('input-invalid');
        }

        // 「メールアドレス」入力欄の空欄チェック
        // フォームの要素を取得
        const mail = document.querySelector('#mail');
        // エラーメッセージを表示させる要素を取得
        const errMsgmail= document.querySelector('.err-msg-mail');
        if(!mail.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgmail.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgmail.textContent = '↑メールアドレスが未入力です。↑';
            // クラスを追加(フォームの枠線を赤くする)
            mail.classList.add('input-invalid');
            // 後続の処理を止める
            error_flag = true;
           
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgmail.textContent ='';
            // クラスを削除
            mail.classList.remove('input-invalid');
        }



        // 「パスワード」入力欄の空欄チェック
        // フォームの要素を取得
        const password = document.querySelector('#password');
        // エラーメッセージを表示させる要素を取得
        const errMsgpassword= document.querySelector('.err-msg-password');
        if(!password.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgpassword.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgpassword.textContent = '↑パスワードが未入力です。↑';
            // クラスを追加(フォームの枠線を赤くする)
            password.classList.add('input-invalid');
            // 後続の処理を止める
            error_flag = true;
           
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgpassword.textContent ='';
            // クラスを削除
            password.classList.remove('input-invalid');
        }

        // 「郵便番号」入力欄の空欄チェック
        // フォームの要素を取得
        const postal_code = document.querySelector('#postal_code');
        // エラーメッセージを表示させる要素を取得
        const errMsgpostal_code= document.querySelector('.err-msg-postal_code');
        if(!postal_code.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgpostal_code.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgpostal_code.textContent = '↑パスワードが未入力です。↑';
            // クラスを追加(フォームの枠線を赤くする)
            postal_code.classList.add('input-invalid');
            // 後続の処理を止める
            error_flag = true;
           
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgpostal_code.textContent ='';
            // クラスを削除
            postal_code.classList.remove('input-invalid');
        }




        // 「住所（都道府県）」入力欄の空欄チェック
        // フォームの要素を取得
        const prefecture = document.querySelector('#prefecture');
        // エラーメッセージを表示させる要素を取得
        const errMsgprefecture= document.querySelector('.err-msg-prefecture');
        if(!prefecture.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgprefecture.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgprefecture.textContent = '↑住所（都道府県）が未入力です。↑';
            // クラスを追加(フォームの枠線を赤くする)
            prefecture.classList.add('input-invalid');
            // 後続の処理を止める
            error_flag = true;
           
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgprefecture.textContent ='';
            // クラスを削除
            prefecture.classList.remove('input-invalid');
        }


        // 「住所（市区町村）」入力欄の空欄チェック
        // フォームの要素を取得
        const address_1 = document.querySelector('#address_1');
        // エラーメッセージを表示させる要素を取得
        const errMsgaddress_1= document.querySelector('.err-msg-address_1');
        if(!address_1.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgaddress_1.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgaddress_1.textContent = '↑住所（市区町村）が未入力です。↑';
            // クラスを追加(フォームの枠線を赤くする)
            address_1.classList.add('input-invalid');
            // 後続の処理を止める
            error_flag = true;
           
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgaddress_1.textContent ='';
            // クラスを削除
            address_1.classList.remove('input-invalid');
        }


        // 「住所（番地）」入力欄の空欄チェック
        // フォームの要素を取得
        const address_2 = document.querySelector('#address_2');
        // エラーメッセージを表示させる要素を取得
        const errMsgaddress_2= document.querySelector('.err-msg-address_2');
        if(!address_2.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgaddress_2.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgaddress_2.textContent = '↑住所（番地）が未入力です。↑';
            // クラスを追加(フォームの枠線を赤くする)
            address_2.classList.add('input-invalid');
            // 後続の処理を止める
            e.preventDefault();
           
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgaddress_2.textContent ='';
            // クラスを削除
            address_2.classList.remove('input-invalid');
        }
        //error_flag = true;があるところにこの関数を実行
        if (error_flag) {
            // 後続の処理を止める
            e.preventDefault();
            
        }
        
    }, false);
}, false);


// window.addEventListener('DOMContentLoaded', function(){

// 	// (1)パスワード入力欄とボタンのHTMLを取得
// 	let btn_passview = document.getElementById("btn_passview");
// 	let password = document.getElementById("password");

// 	// (2)ボタンのイベントリスナーを設定
// 	btn_passview.addEventListener("click", (e)=>{

// 		// (3)ボタンの通常の動作をキャンセル（フォーム送信をキャンセル）
// 		e.preventDefault();

// 		// (4)パスワード入力欄のtype属性を確認
// 		if( password.type === 'password' ) {

// 			// (5)パスワードを表示する
// 			password.type = 'text';
// 			btn_passview.textContent = '非表示';

// 		} else {

// 			// (6)パスワードを非表示にする
// 			password.type = 'password';
// 			btn_passview.textContent = '表示';
// 		}
// 	});

// });