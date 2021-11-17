<!--
    require 는 위에다가 바로 붙이는 것
    그래서 안 닫으면 오류가 난다,
-->

<html>
    <body> 
        <!-- 본문이 시작하는 곳 -->
        <form action="target_file.php" method="POST">
            <!-- 
                Data 전송 범위 시작
                action 으로 잡은 타깃의 모든 데이터의 value가 전송

                전송 방법: GET, POST
                    GET: target_fiel.php?id=1234&pw=12349199&name=iifhj19 <= 누구나 볼 수 있음
                    POST: 숨김
            -->
            <table border="1">
                <!--
                    표 외각 Box
                    표를 둘러쌈
                    요새는 div 를 많이 쓴다고 함
                    div 는 자유자제로 바꿀 수 있음
                    table 은 고정

                    border: 표 선 두께, 0 이면 안 보임
                -->

                <TR>
                    <!--
                        테이블의 Row
                    -->

                    <td>
                        <!-- 테이블 Col -->
                        
                        <!-- <label for="char_name">캐릭터 이름</label> -->
                        <input type="text" name ="char_name" id="char_id">
                        <!--
                            name: $_POST["char_name"];
                            
                            id = HTML 에서 참조하기 위함

                            타입에 따라 바뀌는게 많음
                            Text = 빈칸 텍스트
                            Hidden 칸을 숨김 (사용자에게는 안 보임 )
                            Button 버튼
                            File 파일 올림
                            Radio 옵션 버튼
                            Submit 폼에 있는 데이터를 전송시키는 버튼, 없으면 전송하기 힘듬
                        -->


                    </td>

                </TR>


            </table>


        </form>
        
    </body>
</html>


<?PHP

    // mysqli alter
    // 컬럼 추가 ADD COLUMN
    // 컬럼 변경 MODIFY COLUMN
    // 컬럼 전체 변경 CHANGE COLUMN
    // 컬럼 석제 DROP COLU<M
    // 테이블 이름 변경 RENAME

    // ## UPDATE 할때는 where 먼저 작성 ##

    // SELECT 할때는 LIMIT 을 꼭 붙여줘야 함.
    // 2억게 긁어올수도있음
    // mysqli select

    // myhsqli_fetch_array(결과값); fetch = 가져오다 array = 배열로
    // 값을 가지고 옴
    
    // 하나는 [0] [1] [2] [3] ... (배열)
    // 또 하나는 [id] [name] [date] ... (연관배열) <= 시험?
    // 배열의 숫자가 아니라 필드 네임이 들어간 것이 연관배열
    // fetch_array 는 맨 위 요소를 가지고 왔었으면 다음값을 가지고 옴
    // 마지막 값 다음에는 착하게 null 로 반환함

    /*

    while(A) {
        B
        C
    }

    A 를 실행하고 리턴이 참이면 B, C 실행

    A => 0 != 0 으로 비교함
    그래서 0이 false
    0 말고 나머지 수는 true 가 됨

    대입은 복사해서 붙여넣기
    int a(3) <= 직접 초기화

    PHP = null 이 false
    #define NULL 과 같음

    while($ret_row = musqli_fetch_array())
    {
        두둥탁
    }

    */


?>