import javafx.application.Platform;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import java.util.concurrent.CountDownLatch;
import java.util.concurrent.atomic.AtomicReference;

public class FxAllSmokeTest {
    private static final String[] PATHS = new String[] { "/fxml/admin_dashboard.fxml", "/fxml/appointment_form.fxml", "/fxml/appointment_list.fxml", "/fxml/blog_detail.fxml", "/fxml/blog_form.fxml", "/fxml/blog_list.fxml", "/fxml/daily_tracking.fxml", "/fxml/doctor_dashboard.fxml", "/fxml/login.fxml", "/fxml/product_admin.fxml", "/fxml/product_form.fxml", "/fxml/product_list.fxml", "/fxml/register.fxml", "/fxml/user_dashboard.fxml", "/fxml/user_form.fxml", "/fxml/user_profile.fxml" };

    public static void main(String[] args) throws Exception {
        CountDownLatch latch = new CountDownLatch(1);
        AtomicReference<Throwable> failure = new AtomicReference<>();

        Platform.startup(() -> {
            try {
                for (String path : PATHS) {
                    verify(path);
                }
            } catch (Throwable t) {
                failure.set(t);
            } finally {
                latch.countDown();
                Platform.exit();
            }
        });

        latch.await();
        if (failure.get() != null) {
            failure.get().printStackTrace();
            System.exit(1);
        }
        System.out.println("FX_ALL_SMOKE_OK");
    }

    private static void verify(String path) throws Exception {
        FXMLLoader loader = new FXMLLoader(FxAllSmokeTest.class.getResource(path));
        Parent root = loader.load();
        Scene scene = new Scene(root, 1200, 800);
        scene.getStylesheets().add(FxAllSmokeTest.class.getResource("/css/style.css").toExternalForm());
        root.applyCss();
        root.layout();
        System.out.println("Loaded " + path);
    }
}