<nav class="nav">
    <ul>
        <li class="item home"><a class="<?php if(!$this->uri->segment(1)){echo 'active'; } ?>" href="<?php echo base_url(); ?>">Wektorek.pl</a></li>
		<li class="item crossword"><a class="<?php if(in_array($this->uri->segment(1),['crossword'])){echo 'active';}?>" href="<?php echo base_url("crossword"); ?>">Krzyżówki</a></li>
		<li class="item avatar"><a class="<?php if(in_array($this->uri->segment(1),['avatar'])){echo 'active'; } ?>" href="<?php echo base_url("avatar"); ?>">Awatary</a></li>
        <li class="item humor"><a class="<?php if(in_array($this->uri->segment(1),['humor'])){echo 'active';}?>" href="<?php echo base_url("humor"); ?>">Humor</a></li>
    </ul>
</nav>