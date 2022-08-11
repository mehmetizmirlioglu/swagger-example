<?php
class Example
{
    /**
     * @OA\Info(title="Example API", version="0.1")
     */
    public function __construct($action)
    {
        header("Content-Type: application/json");
        switch($action)
        {
            case "add":
                $this->add();
                break;
            case "update":
                $this->update();
                break;
            case "delete":
                $this->delete();
                break;
        }
    }

    /**
     * @OA\Put(
     *     path="/example/add",
     *     summary="To add a item",
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *           required={"itemName"},
     *           @OA\Property(
     *             description="Name of the item",
     *             property="itemName",
     *             type="string",
     *             format="text"
     *           )
     *         )
     *       )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="The adding process completed successfully.",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="The adding process failed!",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     )
     * )
     */
    private function add()
    {
        $inputJson = json_decode(file_get_contents("php://input"));
        $itemName = $inputJson->itemName;
        echo json_encode(["response"=>"success","message"=>"The adding process completed successfully.","Item"=>["itemId"=>1,"itemName"=>$itemName]]);
    }

    /**
     * @OA\Post(
     *     path="/example/update/{itemId}",
     *     summary="To update the item",
     *     @OA\Parameter(
     *         name="itemId",
     *         in="path",
     *         required=true,
     *         description="The id of the item",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *         mediaType="application/x-www-form-urlencoded",
     *         @OA\Schema(
     *           required={"itemName"},
     *           @OA\Property(
     *             description="Name of the item",
     *             property="itemName",
     *             type="string",
     *             format="text"
     *           )
     *         )
     *       )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="The update process completed successfully.",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="The update process failed!",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     )
     * )
     */
    private function update()
    {
        global $page;
        $itemId = $page[2];
        $itemName = $_POST["itemName"];
        if($itemId != 1)
        {
            http_response_code(400);
            echo json_encode(["response"=>"error","message"=>"The update process failed because item id can not fount in the system!"]);
            return;
        }
        echo json_encode(["response"=>"success","message"=>"The update process completed successfully.","Item"=>["itemId"=>$itemId,"itemName"=>$itemName]]);
    }

    /**
     * @OA\Delete(
     *     path="/example/delete/{itemId}",
     *     summary="To delete the item",
     *     @OA\Parameter(
     *         name="itemId",
     *         in="path",
     *         required=true,
     *         description="The id of the item",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="The delete process completed successfully.",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="The detele process failed!",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     )
     * )
     */
    private function delete()
    {
        global $page;
        $itemId = $page[2];
        if($itemId != 1)
        {
            http_response_code(400);
            echo json_encode(["response"=>"error","message"=>"The delete process failed because item id can not fount in the system!"]);
            return;
        }
        echo json_encode(["response"=>"success","message"=>"The delete process completed successfully."]);
    }
}