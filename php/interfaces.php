<?php
// interfaces.php

interface CRUD {
    public function add($data);
    public function read($matricule);
    public function update($matricule, $data);
    public function delete($matricule);
}
?>
