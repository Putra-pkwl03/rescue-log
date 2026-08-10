from fastapi import FastAPI
from routers.predict_router import router as logistik_router

app = FastAPI(
    title="Rescue Log - Machine Learning Service",
    version="1.0.0"
)

# Registrasi Router
app.include_router(logistik_router)

@app.get("/")
def read_root():
    return {"message": "ML Service Rescue Log is Running"}