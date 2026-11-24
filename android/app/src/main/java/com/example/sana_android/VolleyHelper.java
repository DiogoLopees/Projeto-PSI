package com.example.sana_android;

import android.content.Context;
import android.content.SharedPreferences;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;

public class VolleyHelper {
    private static VolleyHelper instance;
    private RequestQueue requestQueue;
    private static Context ctx;

    private VolleyHelper(Context context) {
        ctx = context.getApplicationContext();
        requestQueue = getRequestQueue();
    }

    public static synchronized VolleyHelper getInstance(Context context) {
        if (instance == null) {
            instance = new VolleyHelper(context);
        }
        return instance;
    }

    public RequestQueue getRequestQueue() {
        if (requestQueue == null) {
            requestQueue = Volley.newRequestQueue(ctx.getApplicationContext());
        }
        return requestQueue;
    }

    public <T> void addToRequestQueue(Request<T> req) {
        getRequestQueue().add(req);
    }

    // Constrói o URL base a partir das SharedPreferences (ex: http://10.0.2.2:8080/api)
    public static String getBaseUrl(Context context) {
        SharedPreferences prefs = context.getSharedPreferences(SettingsActivity.PREFS_NAME, Context.MODE_PRIVATE);
        String ip = prefs.getString(SettingsActivity.KEY_IP, "10.0.2.2");
        String port = prefs.getString(SettingsActivity.KEY_PORT, "8080");
        return "http://" + ip + ":" + port + "/api";
    }

    // Guarda e lê o Token JWT de autenticação
    public static void saveToken(Context context, String token) {
        SharedPreferences prefs = context.getSharedPreferences(SettingsActivity.PREFS_NAME, Context.MODE_PRIVATE);
        prefs.edit().putString("jwt_token", token).apply();
    }

    public static String getToken(Context context) {
        SharedPreferences prefs = context.getSharedPreferences(SettingsActivity.PREFS_NAME, Context.MODE_PRIVATE);
        return prefs.getString("jwt_token", "");
    }
}