<map version="1.0.1">
<!-- To view this file, download free mind mapping software FreeMind from http://freemind.sourceforge.net -->
<node CREATED="1456578035931" ID="ID_1531822801" MODIFIED="1456578360468" TEXT="ProgressiveTask">
<node CREATED="1456578344248" ID="ID_1774320152" MODIFIED="1456578554883" POSITION="right">
<richcontent TYPE="NODE"><html>
  <head>
    
  </head>
  <body>
    <p>
      Accepts a <b>BulkJob</b>&#160;as parameter
    </p>
    <p>
      Practically only BulkJobManager
    </p>
  </body>
</html></richcontent>
<font NAME="SansSerif" SIZE="12"/>
<node CREATED="1456578183078" ID="ID_969831219" MODIFIED="1456578582766">
<richcontent TYPE="NODE"><html>
  <head>
    
  </head>
  <body>
    <p>
      Manages in units of BulkJob
    </p>
    <p>
      Separates load for different BulkJobs
    </p>
  </body>
</html></richcontent>
</node>
<node CREATED="1456578198396" ID="ID_605645628" MODIFIED="1456578213003" TEXT="Is a BulkJob itself, although does not manage itself"/>
<node CREATED="1456578153774" ID="ID_1265375722" MODIFIED="1456578160437" TEXT="CassetteQueue">
<node CREATED="1456578288966" ID="ID_844947173" MODIFIED="1456578292042" TEXT="Is a BulkJob"/>
<node CREATED="1456578050781" ID="ID_80139198" MODIFIED="1456736999489" TEXT="Manages in unit of cassettes">
<node CREATED="1456578082720" ID="ID_1417862052" MODIFIED="1456578104396" TEXT="Each cassette consists of a rewindable stream of block changes"/>
</node>
<node CREATED="1456581259978" ID="ID_1567290729" MODIFIED="1456581265425" TEXT="Cassette">
<node CREATED="1456581266413" ID="ID_57597630" MODIFIED="1456581341526" TEXT="A BlockBuffer to be iterated to get the next block to change">
<node CREATED="1456581363589" ID="ID_1655754891" MODIFIED="1456581422143" TEXT="An internal buffer to allow rewinding"/>
<node CREATED="1456581429090" ID="ID_1997159424" MODIFIED="1456581441111" TEXT="Implemented by different shapes, such as:">
<node CREATED="1456581447706" ID="ID_798162261" MODIFIED="1456581450578" TEXT="filled cuboid"/>
<node CREATED="1456581451010" ID="ID_797393093" MODIFIED="1456581454330" TEXT="hollow sphere"/>
</node>
</node>
<node CREATED="1456581299612" ID="ID_20113417" MODIFIED="1456581320613" TEXT="A BlockChanger to change an iterated block to another block"/>
</node>
<node CREATED="1456580648059" ID="ID_1807422213" MODIFIED="1456580650158" TEXT="Structure">
<node CREATED="1456580650159" ID="ID_777189396" MODIFIED="1456580655369" TEXT="Undo queue">
<node CREATED="1456580655370" ID="ID_494889480" MODIFIED="1456580667649" TEXT="Stores a queue of cassettes to be undone"/>
<node CREATED="1456580667919" ID="ID_1887759838" MODIFIED="1456581228164" TEXT="Oldest cassette is at the beginning, next cassette to undo is at the end"/>
</node>
<node CREATED="1456580921572" ID="ID_1193875372" MODIFIED="1456580925066" TEXT="Current">
<node CREATED="1456580925067" ID="ID_1503969286" MODIFIED="1456580933245" TEXT="The currently undoing/redoing cassette"/>
<node CREATED="1456581090635" ID="ID_711294722" MODIFIED="1456581101124" TEXT="Might end up merging with stack queue to become &quot;current queue&quot;"/>
</node>
<node CREATED="1456580934393" ID="ID_177586353" MODIFIED="1456580940098" TEXT="Redo queue">
<node CREATED="1456580940099" ID="ID_360746552" MODIFIED="1456581046343" TEXT="Stores a queue of cassettes are going to be moved to current or stack queue if //redo is run"/>
<node CREATED="1456581210289" ID="ID_881137369" MODIFIED="1456581232791" TEXT="Next cassette to run at the beginning, last cassette to run at the end"/>
</node>
<node CREATED="1456581048583" ID="ID_772385977" MODIFIED="1456581054572" TEXT="Stack queue">
<node CREATED="1456581054573" ID="ID_751032762" MODIFIED="1456581138378">
<richcontent TYPE="NODE"><html>
  <head>
    
  </head>
  <body>
    <p>
      Stores a queue of cassettes that are going to be immediately shifted into current cassette
    </p>
    <p>
      when the current cassette is done.
    </p>
  </body>
</html></richcontent>
</node>
<node CREATED="1456581186180" ID="ID_850741395" MODIFIED="1456581236347" TEXT="Next cassette to run at the beginning, last cassette to run at the end"/>
</node>
</node>
<node CREATED="1456578108100" ID="ID_421333568" MODIFIED="1456578132171" TEXT="Tick (doOnce)">
<node CREATED="1456578132174" ID="ID_923277371" MODIFIED="1456579123896" TEXT="Execute next/previous action in the current cassette"/>
<node CREATED="1456580005182" ID="ID_1493170957" MODIFIED="1456580007443" TEXT="If done">
<node CREATED="1456580007444" ID="ID_286598099" MODIFIED="1456580012809" TEXT="Move current cassette to undo queue"/>
<node CREATED="1456580013452" ID="ID_344070469" MODIFIED="1456580021050" TEXT="Move next cassette from redo queue to current cassette"/>
</node>
<node CREATED="1456580022501" ID="ID_1249042210" MODIFIED="1456580024156" TEXT="If undone">
<node CREATED="1456580024158" ID="ID_576288511" MODIFIED="1456580038433" TEXT="Decrement undo counter"/>
<node CREATED="1456580038985" ID="ID_489534362" MODIFIED="1456580320787" TEXT="Move current cassette to redo queue and set direction to forwards"/>
<node CREATED="1456580049851" ID="ID_1545913172" MODIFIED="1456580056351" TEXT="If undo counter is still positive">
<node CREATED="1456580056352" ID="ID_1004735404" MODIFIED="1456580638246" TEXT="Move last cassette in undo queue to current"/>
</node>
</node>
</node>
<node CREATED="1456579331632" ID="ID_827314987" MODIFIED="1456579339105" TEXT="Insert">
<node CREATED="1456579339106" ID="ID_167050612" MODIFIED="1456579343775" TEXT="Clear redo queue if any"/>
<node CREATED="1456580179958" ID="ID_650249167" MODIFIED="1456581023706" TEXT="Push into stack queue or current cassette"/>
</node>
<node CREATED="1456579436346" ID="ID_1270747152" MODIFIED="1456579439838" TEXT="Undo">
<node CREATED="1456579455276" ID="ID_1796815224" MODIFIED="1456580253857" TEXT="If stack queue isn&apos;t empty">
<node CREATED="1456580253858" ID="ID_1522558198" MODIFIED="1456580271686" TEXT="Pop the last cassette in the stack queue"/>
<node CREATED="1456580272107" ID="ID_1330578536" MODIFIED="1456580284913" TEXT="Unshift the cassette into the redo queue"/>
</node>
<node CREATED="1456580286517" ID="ID_1574379345" MODIFIED="1456580289980" TEXT="If stack queue is empty">
<node CREATED="1456580289981" ID="ID_668921644" MODIFIED="1456580309679" TEXT="Set the cassette direction to backwards"/>
</node>
<node CREATED="1456580323218" ID="ID_1427531875" MODIFIED="1456580329165" TEXT="If already undoing something">
<node CREATED="1456580329166" ID="ID_428864961" MODIFIED="1456580340335" TEXT="Increment undo counter"/>
</node>
</node>
<node CREATED="1456580341310" ID="ID_1375817966" MODIFIED="1456580342798" TEXT="Redo">
<node CREATED="1456580343774" ID="ID_1810194485" MODIFIED="1456580348106" TEXT="If undoing something">
<node CREATED="1456580348107" ID="ID_564316339" MODIFIED="1456580596024" TEXT="If undo counter &gt; 1">
<node CREATED="1456580587925" ID="ID_1270816921" MODIFIED="1456580594014" TEXT="decrement undo counter"/>
</node>
<node CREATED="1456580596810" ID="ID_464292080" MODIFIED="1456580600911" TEXT="if undo counter = 1">
<node CREATED="1456580601616" ID="ID_269892541" MODIFIED="1456580606706" TEXT="decrement undo counter"/>
<node CREATED="1456580609854" ID="ID_1655161082" MODIFIED="1456580617176" TEXT="set current direction to forwards"/>
</node>
<node CREATED="1456581148012" ID="ID_1605829610" MODIFIED="1456581152500" TEXT="if undo counter = 0">
<node CREATED="1456581152501" ID="ID_1327562070" MODIFIED="1456581180050" TEXT="shift next in redo queue to stack queue or current cassette"/>
</node>
</node>
</node>
</node>
</node>
<node CREATED="1456578499085" ID="ID_796753809" MODIFIED="1456578562435" POSITION="right">
<richcontent TYPE="NODE"><html>
  <head>
    
  </head>
  <body>
    <p>
      Stops ticking the BulkJob(Manager) implementation
    </p>
    <p>
      if defined load threshold is reached
    </p>
  </body>
</html></richcontent>
</node>
</node>
</map>
