<?php

class Controller
{
    public function delete($query, $konek)
    {
        if ($konek->query($query)) {
            $result = "success";
        } else {
            $result = 'failed' . $konek->error;
        }
        echo json_encode($result);
        $konek->close();
    }
    public function addData($queryCek, $query, $konek)
    {
        if ($konek->query($queryCek)->num_rows > 0) {
            echo "<script>alert('Data sudah ada!');history.go(-1);</script>";
        } elseif ($konek->query($query)) {
            $result = "success";
        } else {
            $result = 'failed' . $konek->error;
        }
        echo json_encode($result);
        $konek->close();
    }

    public function update($query, $konek)
    {
        if ($konek->multi_query($query)) {
            $result = "success";
        } else {
            $result = 'failed' . $konek->error;
        }
        echo json_encode($result);
        $konek->close();
    }
}
