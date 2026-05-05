import javafx.application.Platform;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import java.util.concurrent.CountDownLatch;
import java.util.concurrent.atomic.AtomicReference;

public class FxSmokeTest {
    public static void main(String[] args) throws Exception {
        CountDownLatch latch = new CountDownLatch(1);
        AtomicReference<Throwable> failure = new AtomicReference<>();

        Platform.startup(() -> {
            try {
                verify("/fxml/login.fxml");
                verify("/fxml/daily_tracking.fxml");
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
        System.out.println("FX_SMOKE_OK");
    }

    private static void verify(String path) throws Exception {
        FXMLLoader loader = new FXMLLoader(FxSmokeTest.class.getResource(path));
        Parent root = loader.load();
        Scene scene = new Scene(root, 1200, 800);
        scene.getStylesheets().add(FxSmokeTest.class.getResource("/css/style.css").toExternalForm());
        root.applyCss();
        root.layout();
    }
}