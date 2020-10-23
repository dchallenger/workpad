<style type="text/css">
.tree,
.tree ul,
.tree li {
    list-style: none;
    margin: 0;
    padding: 0;
    position: relative;
}

.tree {
    margin: 0 0 1em;
    text-align: center;
}

.tree,
.tree ul {
    display: table;
}

.tree ul {
    width: 100%;
}

.tree li {
    display: table-cell;
    padding: .5em 0;
    vertical-align: top;
}

.tree li:before {
    outline: solid 1px #666;
    content: "";
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
}

.tree li:first-child:before {
    left: 50%;
}

.tree li:last-child:before {
    right: 50%;
}

.tree code,
.tree span {
    border: solid .1em #666;
    border-radius: .2em;
    display: inline-block;
    margin: 0 .2em .5em;
    padding: .2em .5em;
    position: relative;
}

.tree ul:before,
.tree code:before,
.tree span:before {
    outline: solid 1px #666;
    content: "";
    height: .5em;
    left: 50%;
    position: absolute;
}

.tree ul:before {
    top: -.5em;
}

.tree code:before,
.tree span:before {
    top: -.55em;
}

.tree>li {
    margin-top: 0;
}

.tree>li:before,
.tree>li:after,
.tree>li>code:before,
.tree>li>span:before {
    outline: none;
}
</style>

<ul class="tree">
  <li> <span>Home</span>
    <ul>
      <li> <span>About us</span>
        <ul>
          <li> <span>Our history</span>
            <ul>
              <li><span>Founder</span></li>
            </ul>
          </li>
          <li> <span>Our board</span>
            <ul>
              <li><span>Brad Whiteman</span></li>
              <li><span>Cynthia Tolken</span></li>
              <li><span>Bobby Founderson</span></li>
            </ul>
          </li>
        </ul>
      </li>
      <li> <span>Our products</span>
        <ul>
          <li> <span>The Widget 2000™</span>
            <ul>
              <li><span>Order form</span></li>
            </ul>
          </li>
          <li> <span>The McGuffin V2</span>
            <ul>
              <li><span>Order form</span></li>
            </ul>
          </li>
        </ul>
      </li>
      <li> <span>Contact us</span>
        <ul>
          <li> <span>Social media</span>
            <ul>
              <li><span>Facebook</span></li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </li>
</ul>