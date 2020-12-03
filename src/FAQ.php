<?php

namespace sitvago;

class FAQ extends DB
{
    public function getFAQs()
    {
        $results = [];
        $sql = "SELECT FAQ.id, FAQ.question, FAQ.answer, FAQCategory.category_name, FAQCategory.id AS cat_id, FAQ.created_at, c.first_name AS created_by, 
        FAQ.updated_at, u.first_name AS updated_by FROM FAQ LEFT JOIN User c ON FAQ.created_by = c.id 
        LEFT JOIN User u ON FAQ.updated_by = u.id LEFT JOIN FAQCategory ON FAQ.category_id = FAQCategory.id;";

        $resultsSQL = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }
        return $results;
    }

    public function getFAQCategoriesPublic()
    {
        $results = [];
        $sqlOuter = "SELECT FAQCategory.id, FAQCategory.category_name FROM FAQCategory";

        $resultsOuterSQL = mysqli_query($this->conn, $sqlOuter);

        if (mysqli_num_rows($resultsOuterSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsOuterSQL)) {
                $results[] = $row;
            }
        }

        return $results;
    }

    public function getFAQsPublic()
    {
        $results = [];
        $resultsOuter = array();
        $sqlInner = "SELECT FAQ.id, FAQ.question, FAQ.answer, FAQCategory.category_name, FAQCategory.id AS cat_id, FAQ.created_at, c.first_name AS created_by, 
        FAQ.updated_at, u.first_name AS updated_by FROM FAQ LEFT JOIN User c ON FAQ.created_by = c.id 
        LEFT JOIN User u ON FAQ.updated_by = u.id LEFT JOIN FAQCategory ON FAQ.category_id = FAQCategory.id;";

        $resultsSQL = mysqli_query($this->conn, $sqlInner);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }

        //$resultsSQL = mysqli_query($this->conn, $sqlInner);

        // if (mysqli_num_rows($resultsSQL) > 0) {
        //     while ($row = mysqli_fetch_assoc($resultsSQL)) {
        //         foreach ($resultsOuter as $catName) {
        //             if ($row['cat_name'] === $catName) {
        //                 $results[$catName] = $row;
        //                 break;
        //             }
        //         }
        //     }
        // }
        return $results;
    }

    public function getFAQCategories()
    {
        $results = [];
        $sql = "SELECT FAQCategory.id, FAQCategory.category_name, FAQCategory.created_at, c.first_name AS created_by, 
        FAQCategory.updated_at, u.first_name AS updated_by FROM FAQCategory LEFT JOIN User c ON FAQCategory.created_by = c.id 
        LEFT JOIN User u ON FAQCategory.updated_by = u.id;";

        $resultsSQL = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }
        return $results;
    }

    public function addFAQ($faqQuestion, $faqAnswer, $faqCategory, $userID)
    {
        $response = [];
        $success = true;
        $preparedSQL = "INSERT INTO FAQ (question, answer, created_at, created_by, updated_at, updated_by, category_id) SELECT ?, ?, now(),
        (SELECT User.id FROM User WHERE User.id = ?), now(), (SELECT User.id FROM User WHERE User.id = ?), FAQCategory.id FROM FAQCategory WHERE FAQCategory.id=?";

        if ($this->conn->connect_error) {
            $errorMsg = "Connection failed: " . $this->conn->connect_error;
            $success = false;
            $response['success'] = $success;
            $response['message'] = $errorMsg;
            $response['error'] = $errorMsg;
        } else {
            $stmt = $this->conn->prepare($preparedSQL);
            $stmt->bind_param("ssiii", $faqQuestion, $faqAnswer, $userID, $userID, $faqCategory);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ")" . $stmt->error;
                $response['success'] = $success;
                $response['message'] = $errorMsg;
                $response['error'] = $errorMsg;
            } else {
                $response['success'] = $success;
                $response['message'] = "FAQ has been successfully added into the database!!";
                $response['error'] = "";
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }

    public function updateFAQ($faqID)
    {
    }

    public function deleteFAQ($faqID)
    {
    }
}
