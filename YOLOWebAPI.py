import torch
from matplotlib import pyplot as plt
import numpy as np
import cv2
import flask as fsk

def detectFloorPlan():
    model = torch.hub.load('ultralytics/yolov5', 'custom', path='yolov5/runs/train/exp17/weights/last.pt', force_reload=True)
    img = 'yolov5/data/images/test.png'
    results = model(img)
    print(results)

    """zones_cor = results.pandas().xyxy[0]
    frame =np.zeros((786,1024,3), np.uint8)
    zones = []
    elements = []

    for index, zc in zones_cor.iterrows():
        if zc['name']=='Zone':
            cv2.rectangle(frame, (int(zc['xmin']/2),int(zc['ymin']/2)), (int(zc['xmax']/2),int(zc['ymax']/2)), (0, 255, 0), 2)
            w = zc['xmax'] - zc['xmin']
            l = zc['ymax'] - zc['ymin']
            zones.append({"length":l, "width":w, "xmin":zc["xmin"], "ymin":zc["ymin"], "xmax":zc["xmax"], "ymax":zc["ymax"]})
        elements.append(zc["name"])
            #cv2.imshow("OutputWindow",frame)
    #cv2.waitKey()"""

    plt.imshow(np.squeeze(results.render()))
    plt.savefig('result.png')

    return results



app = fsk.Flask(__name__)

@app.route("/predict", methods=["POST"])
def predict():
    result = detectFloorPlan()
    #response = {"result": result}
    return "200"

if __name__ == "__main__":
    app.run(port=5000, debug = True)